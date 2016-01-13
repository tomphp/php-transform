# Transform

[![Build Status](https://travis-ci.org/tomphp/php-transform.svg?branch=master)](https://travis-ci.org/tomphp/php-transform)

Predicate is a simple library which aims to make using PHP's `array_map`
function a more pleasant experience - and resulting in cleaner code.

Predicate is a collection of helper functions for common transform actions.

For a great companion library of predicates to make your `array_filter` code also look great, see [Pentothal](https://github.com/Giuseppe-Mazzapica/Pentothal).

## Namespace

From this point on, assume the `TomPHP\Transform` namespace is used like so:

```php
use TomPHP\Transform as T;
```

## Example

Take this code:

```php
$names = array_map(
    function ($user) {
        return $user->getName();
    },
    $allUsers
);
```

Using transform this looks like this:

```php
$names = array_map(T\callMethod('getName'), $allUsers);
```

## Installation

Using composer:

`composer require tomphp/transform`

## Chaining

Multiple transformations can be composed using the `chain` function:

```php
T\chain(T\getProperty('user'), T\getElement('name'));

// Is equivalent to:

function ($object) {
    return $object->user['name'];
}

```

## Transformations

### T\callMethod($methodName, ...$args)

```php
T\classMethod('getName');

// Is equivalent to:

function ($object) {
    return $object->getName();
}
```

```php
T\classMethod('format', 'Y-m-d');

// Is equivalent to:

function ($object) {
    return $object->format('Y-m-d');
}
```

### T\getProperty($name)

```php
T\getProperty('name');

// Is equivalent to:

function ($object) {
    return $object->name;
}
```

### T\getElement($name)

```php
T\getElement('name');

// Is equivalent to:

function ($array) {
    return $array['name'];
}
```

```php
T\getElement(['user', 'name']);

// Is equivalent to:

function ($array) {
    return $array['user']['name'];
}
```

### T\argumentTo($callable)

```php
T\argumentTo('strtolower');

// Is equivalent to:

function ($value) {
    return strtolower($value);
}
```

`$callable` can be any of the following:

* `'functionName'`
* `function ($value) { /* ... */ }`
* `[$object, 'methodName']`
* `['ClassName', 'staticMethodName']`
