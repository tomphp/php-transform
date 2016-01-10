<?php

namespace TomPHP\Predicate;

final class Transform
{
    /**
     * Returns a transformer which calls $methodName on its argument and returns
     * the result.
     *
     * @param string $methodName
     *
     * @return callable
     */
    public static function callMethod($methodName)
    {
        return function ($object) use ($methodName) {
            return $object->$methodName();
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
    public static function getEntry($name)
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
     * Returns a transformer calls the given callable with its value as the
     * argument and returns the result.
     *
     * @param string|string[] $name Providing an array will walk multiple levels
     *                              into the array.
     *
     * @return callable
     */
    public static function argumentTo($callable)
    {
        return function ($value) use ($callable) {
            return $callable($value);
        };
    }
}
