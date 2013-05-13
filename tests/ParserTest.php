<?php

use CustomTagParser\Parser;

class CustomTagParserParserTest extends PHPUnit_Framework_TestCase {

  public function testGetTags() {
    $text = '<foo /> <bar /><foo>';
    $parser = new Parser($text);

    $foos = $parser->tags('foo');
    $bars = $parser->tags('bar');

    $this->assertEquals(2, count($foos));
    $this->assertEquals(1, count($bars));
  }

  public function testSimpleReplace() {
    $text = '<foo>';
    $parser = new Parser($text);

    foreach($parser->tags('foo') as $tag) {
      $tag->replaceWith('Foo');
    }

    $this->assertEquals('Foo', $parser->toString());
  }

  public function testAdvancedReplace() {
    $text = '<fizz i="3"> <fizz i="5" /> <fizz i="15"> <fizz i="14">';
    $parser = new Parser($text);

    foreach($parser->tags('fizz') as $tag) {

      if(0 == $tag->i % 15) {
        $tag->replaceWith('FooBar');
      }
      else if(0 == $tag->i % 5) {
        $tag->replaceWith('Bar');
      }
      else if(0 == $tag->i % 3) {
        $tag->replaceWith('Foo');
      }
    }

    $this->assertEquals('Foo Bar FooBar <fizz i="14">', $parser->toString());
  }

  public function testRemoveInReplace() {
    $text = '<ipsum text="Lorem"> <ipsum text="dolor"> <ipsum text="sit">';
    $parser = new Parser($text);

    foreach($parser->tags('ipsum') as $tag) {

      if('sit' == $tag->text) {
        $tag->remove();
      }
      else {
        $tag->replaceWith($tag->text);
      }
    }

    $this->assertEquals('Lorem dolor ', $parser->toString());
  }

}
