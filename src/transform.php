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
function chain(...$fns)
{
    return function ($value) use ($fns) {
        return array_reduce(
            $fns,
            function ($carry, $fn) {
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
<<<<<<< HEAD
 * @param array  $arguments
=======
 * @param array  $args
>>>>>>> refs/remotes/origin/type-constrain
 *
 * @return callable
 */
function callMethod($methodName, ...$args)
{
<<<<<<< HEAD
=======
    if (!is_string($methodName)) {
        throw new \InvalidArgumentException(
            sprintf('%s expects strings as method name.', __FUNCTION__)
        );
    }

>>>>>>> refs/remotes/origin/type-constrain
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
 */
function getElement($name)
{
    if (!is_array($name)) {
        return function ($array) use ($name) {
            return $array[$name];
        };
    }

    return function ($array) use ($name) {
        foreach ($name as $key) {
<<<<<<< HEAD
            $array = $array[$key];
=======
            $fn = getElement($key);
            $array = $fn($array);
>>>>>>> refs/remotes/origin/type-constrain
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
 */
function getProperty($name)
{
    if (!is_array($name)) {
        return function ($array) use ($name) {
            return $array[$name];
        };
    }
}

/**
 * Returns a transformer calls the given callable with its value as the
 * argument and returns the result.
 *
 * @param string|string[] $name Providing an array will walk multiple levels
 *                              into the array.
 *
 * @return callable
 */
function argumentTo($callable)
{
    return function ($value) use ($callable) {
        return $callable($value);
    };
}
