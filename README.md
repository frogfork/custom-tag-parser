# Installing

- Install [Composer](http://getcomposer.org)

- Add `radmen/custom-tag-parser` to your project's `composer.json:

```json
{
    "require": {
        "radmen/custom-tag-parser": "dev-master"
    }
}
```

- Install/update your dependencies

# Example

```php
<?php
$parser = new CustomTagParser\Parser('<fizz i="3"> <fizz i="5" /> <fizz i="15">');

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
