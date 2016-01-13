<?php

namespace TomPHP\Transform;

/**
 * Chains a number of arity 1 functions together, passing the output of
 * each to the next.
 *
 * @param callable[] $fns
 *
 * @return callable
 */
function chain(callable ...$fns)
{
    return function ($value) use ($fns) {
        return array_reduce(
            $fns,
            function ($carry, callable $fn) {
                return $fn($carry);
            },
            $value
        );
    };
}

/**
 * Returns a transformer which calls $methodName on its argument and returns
 * the result.
 *
 * @param string $methodName
 * @param array  $args
 *
 * @return callable
 * @throws \InvalidArgumentException
 */
function callMethod($methodName, ...$args)
{
    if (!is_string($methodName)) {
        throw new \InvalidArgumentException(
            sprintf('%s expects strings as method name.', __FUNCTION__)
        );
    }

    return function ($object) use ($methodName, $args) {
        return $object->$methodName(...$args);
    };
}

/**
 * Returns a transformer which fetches index $name from its argument and
 * returns the result.
 *
 * @param string|string[] $name Providing an array will walk multiple levels
 *                              into the array.
 *
 * @return callable
 * @throws \InvalidArgumentException
 */
function getElement($name)
{
    if (!is_array($name)) {
        return function ($array) use ($name) {
            if (is_object($array) && !$array instanceof \ArrayAccess) {
                return $array->{$name};
            } elseif ($array instanceof \ArrayAccess || (is_array($array) && is_string($name))) {
                return $array[$name];
            }

            throw new \InvalidArgumentException('Tried to get entry from a scalar variable.');
        };
    }

    return function ($array) use ($name) {
        foreach ($name as $key) {
            $fn = getElement($key);
            $array = $fn($array);
        }

        return $array;
    };
}

/**
 * Alias to getElement().
 *
 * @param string|string[] $name Providing an array will walk multiple levels
 *                              into the array.
 *
 * @return callable
 *
 * @deprecated
 */
function getEntry($name)
{
    return getElement($name);
}

/**
 * Returns a transformer which gets the value of property $name from its
 * argument and returns the result.
 *
 * @param string $name
 *
 * @return callable
 * @throws \InvalidArgumentException
 */
function getProperty($name)
{
    if (is_array($name)) {
        throw new \InvalidArgumentException('Tried to use variable of type array as array key.');
    }

    return function ($array) use ($name) {
        if (!is_object($array) && ! is_array($array)) {
            throw new \InvalidArgumentException('Tried to get entry from a scalar variable.');
        }

        return $array instanceof \ArrayAccess || (is_array($array) && is_string($name))
            ? $array[$name]
            : $array->{$name};
    };
}

/**
 * Returns a transformer calls the given callable with its value as the
 * argument and returns the result.
 *
 * @param callable $callable
 *
 * @return callable
 */
function argumentTo(callable $callable)
{
    return function ($value) use ($callable) {
        return $callable($value);
    };
}
