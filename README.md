# Predicate

Predicate is a simple library which aims to make using PHP's `array_map` and
`array_filter` functions a more pleasent experience - and resulting in cleaner
code.

Predicate is a collection of helper functions for common filter and transform
actions.

## Example

Take this code:

```php
$customers = array_filter(
    $allUsers,
    function ($user) {
        return $user->getType() === 'customer';
    }
);
```

Using predicate this looks like this:

```php
$customer = array_filter($allUsers, Filter::hasMethodReturning('getType', 'customer'));
```

## Installation

Using composer:

`composer require tomphp/predicate`

## Filters

All filters are defined as static methods on `TomPHP\Predicate\Filter`.

So far the following filters are provided:

```
isNull()
notNull()
isSameAs($expected)
notSameAs($expected)
isLike($expected)
notLike($expected)
hasMethodReturning(string $methodName, $expected, bool strict = true)
notHasMethodReturning(string $methodName, $expected, bool strict = true)
```

By convention: all functions starting with `is` are negated by replacing the
p`is` with `not`, and all function staring with `has` are negated prefixing
`not`.

## Transforms

Transforms are for use with `array_map`.

Transforms are used to replace code like this:

```php
$names = array_map(
    function ($user) {
        return $user->getName();
    },
    $allUsers
);
```

With code like this:

```php
$names = array_map(Transform::callMethod('getName'), $allUsers);
```

### Transform::callMethod($methodName)

```php
Transform::classMethod('getName');

// Generates:

function ($object) {
    return $object->getName;
}
```

### Transform::getEntry($name)

```php
Transform::getEntry('name');

// Generates:

function ($array) {
    return $array['name'];
}
```

```php
Transform::getEntry(['user', 'name']);

// Generates:

function ($array) {
    return $array['user']['name'];
}
```

### Transform::argumentTo($callable)

```php
Transform::getEntry('strtolower');

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
