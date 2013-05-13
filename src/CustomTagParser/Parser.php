<?php namespace CustomTagParser;

class Parser {

  private $tags = array();

  private $text;

  public function __construct($text) {
    $this->text = $text;
  }

  public function tags($tag) {

    if(true === isset($this->tags[$tag])) {
      return $this->tags[$tag];
    }

    $this->tags[$tag] = $this->findTags($tag);

    return $this->tags[$tag];
  }

  private function findTags($tag) {
    $regex = "/<{$tag}[^>]*?>/";
    $match = array();
    $list = array();

    preg_match_all($regex, $this->text, $match, PREG_SET_ORDER);

    foreach($match as $part) {
      $list[] = new Tag($part[0]);
    }

    return $list;
  }

  public function toString() {
    $tmp = $this->text;

    foreach($this->tags as $name => $tags) {

      foreach($tags as $item) {
        $regex = sprintf('/%s/', preg_quote($item->tag(), '/'));
        $replace_with = $item->replaceWith();

        if(null === $replace_with) {
          continue;
        }

        $tmp = preg_replace($regex, $replace_with, $tmp, 1);
      }
    }

    return $tmp;
  }

  public function __toString() {
    return $this->toString();
  }

}
