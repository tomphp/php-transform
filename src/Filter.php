<?php

namespace TomPHP\Predicate;

/**
 * @method static bool isNull()
 * @method static bool notNull()
 * @method static bool isSameAs($expected)
 * @method static bool notSameAs($expected)
 * @method static bool isLike($expected)
 * @method static bool notLike($expected)
 * @method static bool hasMethodReturning(string $methodName, $expected, bool strict = true)
 * @method static bool notHasMethodReturning(string $methodName, $expected, bool strict = true)
 */
final class Filter
{
    const NOT_STRICT = false;
    const STRICT     = true;

    /**
     * @param string $name
     * @param array  $args
     *
     * @return callable
     */
    public static function __callStatic($name, array $args)
    {
        if (strpos($name, 'is') === 0) {
            $name = lcfirst(substr($name, 2));

            return call_user_func_array([__CLASS__, $name], $args);
        } elseif (strpos($name, 'has') === 0) {
            $name = lcfirst(substr($name, 3));

            return call_user_func_array([__CLASS__, $name], $args);
        } elseif (strpos($name, 'not') === 0) {
            $name = lcfirst(substr($name, 3));

            return self::complement(call_user_func_array([__CLASS__, $name], $args));
        }
    }

    /**
     * @param callable $fn
     *
     * @return callable
     */
    private static function complement(callable $fn)
    {
        return function (...$args) use ($fn) {
            return !$fn(...$args);
        };
    }

    /**
     * @return callable
     */
    private static function null()
    {
        return function ($value) {
            return is_null($value);
        };
    }

    /**
     * @param mixed $expected
     *
     * @return callable
     */
    private static function sameAs($expected)
    {
        return function ($value) use ($expected) {
            return $value === $expected;
        };
    }

    /**
     * @param mixed $expected
     *
     * @return callable
     */
    private static function like($expected)
    {
        return function ($value) use ($expected) {
            return $value == $expected;
        };
    }

    /**
     * @param string $methodName
     * @param mixed  $expected
     * @param bool   $strict
     *
     * @return callable
     */
    private static function methodReturning($methodName, $expected, $strict = self::STRICT)
    {
        if ($strict === self::STRICT) {
            return function ($object) use ($methodName, $expected) {
                return $object->$methodName() === $expected;
            };
        }

        return function ($object) use ($methodName, $expected) {
            return $object->$methodName() == $expected;
        };
    }
}
