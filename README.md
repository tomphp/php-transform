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

## Transformers

Transforms are for use with `array_map`.

There are currently no transformers defined but they will replace code like
this:

```php
$names = array_map(
    function ($user) {
        return $user->getName();
    },
    $allUsers
);
```

With predicate, code the code will look like this:

```php
$names = array_map(Transformer::callMethod('getName'), $allUsers);
```
