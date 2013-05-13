<?php namespace CustomTagParser;

class Tag {

  private $tag;

  private $attributes = array();

  private $replaceWith;

  public function __construct($tag) {
    $this->tag = $tag;
    $this->attributes = $this->parseAttributes();
  }

  public function tag() {
    return $this->tag;
  }

  private function parseAttributes() {
    $regex = '/(\w+)=(?:"([^"]+?)"|(\w+))/';
    $match = array();
    $attributes = array();

    preg_match_all($regex, $this->tag, $match, PREG_SET_ORDER);

    foreach($match as $item) {

      if(true === isset($item[3])) {
        $attributes[$item[1]] = $item[3];
      }
      else {
        $attributes[$item[1]] = $item[2];
      }
    }

    return $attributes;
  }

  public function replaceWith($string = null) {

    if(null === $string) {
      return $this->replaceWith;
    }

    $this->replaceWith = $string;
  }

  public function remove() {
    $this->replaceWith = '';
  }

  public function __get($name) {
    return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
  }

}
