# Example

```php
<?php
$parser = new Parser('<fizz i="3"> <fizz i="5" /> <fizz i="15">');

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

$parser->toString(); // Foo Bar FooBar
```
