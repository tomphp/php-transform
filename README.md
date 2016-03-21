# Transform

[![Build Status](https://travis-ci.org/tomphp/php-transform.svg?branch=master)](https://travis-ci.org/tomphp/php-transform)

Transform is a simple library which aims to make using PHP's `array_map`
function a more pleasant experience - and resulting in cleaner code.

Transform is a collection of helper functions for common transform actions.

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

Using Transform this looks like this:

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

## The Traversal Builder

If you want to chain together a collection of `callMethod`, `getProperty` and
`getElement` calls, the `__()` function provides a builder to write this in
a more elegant way.

Consider:

```php
$dobs = array_map(
    function (User $user) {
        return $user->getMetaData()['dob']->format('Y-m-d');
    },
    $users
);
```

With the builder you can simply write:

```php
use function TomPHP\Transform\__;

$dobs = array_map(__()->getMetaData()['dob']->format('Y-m-d'), $users);
```

## Transformations

### Object Transformations

#### T\callMethod(string $methodName, mixed ...$args)

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

#### T\callStatic(string $methodName, mixed ...$args)
```php
T\callStatic('getSomethingWith', 'param1', 'param2');

// Is equivalent to:

function ($object) {
    return $object::getSomethingWith('param1', 'param2');
}

// or to:
function ($classAsString) {
    return $classAsString::getSomethingWith('param1', 'param2');
}
```

#### T\getProperty(string $name)

```php
T\getProperty('name');

// Is equivalent to:

function ($object) {
    return $object->name;
}
```

### Array Transformations

#### T\getElement(string|int $name)

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

### String Transformations

#### T\prepend(string $prefix)

```php
T\prepend('prefix: ');

// Is equivalent to:

function ($value) {
    return 'prefix: ' . $value;
}
```

#### T\append(string $suffix)

```php
T\prepend(' - suffix');

// Is equivalent to:

function ($value) {
    return $value . ' - suffix';
}
```

### Generic Transformations

#### T\argumentTo(callable $callable, array $argments = [__])

```php
T\argumentTo('strtolower');

// Is equivalent to:

function ($value) {
    return strtolower($value);
}
```

You can also provide a list of arguments using `__` as the placeholder for where
you want the value inserted:

```php
use const TomPHP\Transform\__;

T\argumentTo('strpos', ['Tom: My name is Tom', __, 4]);

// Is equivalent to:

function ($value) {
    return strpos('Tom: My name is Tom', $value, 4);
}
```

#### T\newInstance(string $className, array $arguments = [__])

```php
T\newInstance(Widget::class);

// Is equivalent to:

function ($value) {
    return new Widget($value);
}
```

You can also provide a list of arguments using `__` as the placeholder for where
you want the value inserted:

```php
use const TomPHP\Transform\__;

T\newInstance(Widget, ['first', __, 'last']);

// Is equivalent to:

function ($value) {
    return new Widget('first', $value, 'last');
}
```
