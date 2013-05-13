<?php
class CustomTagParserTagTest extends PHPUnit_Framework_TestCase {

  public function testGetters() {
    $tag = new CustomTagParser\Tag('<foo name="test" i=5/>');

    $this->assertEquals('test', $tag->name);
    $this->assertEquals('5', $tag->i);
    $this->assertNull($tag->foo);
  }

}
