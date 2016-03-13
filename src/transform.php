<?php

namespace TomPHP\Transform;

use TomPHP\Transform\Exception\InvalidArgumentException;
use TomPHP\Transform\Exception\UnexpectedValueException;

/**
 * Represents a placeholder in an argument list.
 */
const __ = 'Super Unique Placeholder String - 6f74f07a-bc60-494a-93e0-eefedb69849b';

/**
 * Chains a number of arity 1 functions together, passing the output of
 * each to the next.
 *
 * @param callable[] $fns
 *
 * @return \Closure
 */
function chain(callable ...$fns)
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
 * Returns a Builder instance.
 *
 * @return Builder
 */
function __()
{
    return new Builder();
}

/**
 * Returns a transformer which calls $methodName on its argument and returns
 * the result.
 *
 * @param string $methodName
 * @param array  $args
 *
 * @return \Closure
 *
 * @throws \TomPHP\Transform\Exception\ExpectedStringTrait
 */
function callMethod($methodName, ...$args)
{
    if (!is_string($methodName)) {
        throw InvalidArgumentException::expectedString('methodName', $methodName);
    }

    return function ($object) use ($methodName, $args) {
        if (!is_object($object)) {
            throw UnexpectedValueException::expectedObject('object', $object);
        }

        if (!method_exists($object, $methodName)) {
            throw UnexpectedValueException::expectedMethod($object, $methodName);
        }

        return $object->$methodName(...$args);
    };
}

function callStatic($methodName, ...$args)
{
    if (!is_string($methodName)) {
        throw InvalidArgumentException::expectedString('methodName', $methodName);
    }

    return function ($objectOrClass) use ($methodName, $args) {

        if (is_object($objectOrClass)) {
            $reflectedClass = new \ReflectionObject($objectOrClass);
            $subjectObject = $objectOrClass;
        } else {
            if (!class_exists($objectOrClass)) {
                throw InvalidArgumentException::expectedValidClassName($objectOrClass);
            }

            $reflectedClass = new \ReflectionClass($objectOrClass);
            $subjectObject = null;
        }

        if (!$reflectedClass->hasMethod($methodName)) {
            throw UnexpectedValueException::expectedMethod($reflectedClass->getName(), $methodName);
        }

        $methodToCall = $reflectedClass->getMethod($methodName);
        if (!$methodToCall->isStatic()) {
            throw UnexpectedValueException::expectedStaticMethod($reflectedClass->getName(), $methodName);
        } elseif (!$methodToCall->isPublic()) {
            throw UnexpectedValueException::expectedPublicMethod($reflectedClass->getName(), $methodName);
        }

        return $methodToCall->invokeArgs($subjectObject, $args);
    };
}

/**
 * Returns a transformer which fetches index $name from its argument and
 * returns the result.
 *
 * @param string|string[] $name Providing an array will walk multiple levels
 *                              into the array.
 *
 * @return \Closure
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
            $array = $array[$key];
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
 * @return \Closure
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
 * @return \Closure
 */
function getProperty($name)
{
    if (!is_array($name)) {
        return function ($array) use ($name) {
            return $array->$name;
        };
    }
}

/**
 * Returns a transformer calls the given callable with its value as the
 * argument and returns the result.
 *
 * @param callable $callable  Providing an array will walk multiple levels into
 *                            the array.
 * @param mixed[]  $arguments Use __ to indicate where the value should be
 *                            placed in the argument list.
 *
 * @return \Closure
 */
function argumentTo(callable $callable, array $arguments = [__])
{
    return function ($value) use ($callable, $arguments) {
        $arguments = array_map(
            function ($arg) use ($value) {
                return $arg === __ ? $value : $arg;
            },
            $arguments
        );

        return $callable(...$arguments);
    };
}

/**
 * Returns a transformer which prepends $prefix onto its value.
 *
 * @param string $prefix
 *
 * @return \Closure
 *
 * @throws \TomPHP\Transform\Exception\ExpectedStringTrait
 */
function prepend($prefix)
{
    if (!is_string($prefix)) {
        throw InvalidArgumentException::expectedString('prefix', $prefix);
    }

    return function ($value) use ($prefix) {
        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw UnexpectedValueException::expectedString('value', $value);
        }

        return $prefix.$value;
    };
}

/**
 * Returns a transformer which appends $suffix onto its value.
 *
 * @param string $suffix
 *
 * @return \Closure
 *
 * @throws \TomPHP\Transform\Exception\ExpectedStringTrait
 */
function append($suffix)
{
    if (!is_string($suffix)) {
        throw InvalidArgumentException::expectedString('suffix', $suffix);
    }

    return function ($value) use ($suffix) {
        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw UnexpectedValueException::expectedString('value', $value);
        }

        return $value.$suffix;
    };
}
