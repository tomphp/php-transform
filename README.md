# Predicate

Predicate is a simple library which aims to make using PHP's `array_map`
function a more pleasent experience - and resulting in cleaner code.

Predicate is a collection of helper functions for common transform actions.

For a great companion library of predicates to make your `array_filter` code also look great, see [Pentothal](https://github.com/Giuseppe-Mazzapica/Pentothal).

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

## Transformations

```php
use TomPHP\T as T;
```

### T\callMethod($methodName)

```php
T\classMethod('getName');

// Generates:

function ($object) {
    return $object->getName;
}
```

### T\getEntry($name)

```php
T\getEntry('name');

// Generates:

function ($array) {
    return $array['name'];
}
```

```php
T\getEntry(['user', 'name']);

// Generates:

function ($array) {
    return $array['user']['name'];
}
```

### T\argumentTo($callable)

```php
T\getEntry('strtolower');

// Generates:

function ($value) {
    return strtolower($value);
}
```

`$callable` can be any of the following:

* `'functionName'`
* `function ($value) { /* ... */ }`
* `[$object, 'methodName']`
* `['ClassName', 'staticMethodName']`
