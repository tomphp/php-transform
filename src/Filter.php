<?php

namespace TomPHP\Predicate;

/**
 * @method static callable isNull()
 *         Returns a filter which removes non-null values.
 * @method static callable notNull()
 *         Returns a filter which removes null values.
 * @method static callable isSameAs($expected)
 *         Returns a filter which checks if its argument is the same as $expected.
 * @method static callable notSameAs($expected)
 *         Returns a filter which checks if its argument is not the same as $expected.
 * @method static callable isLike($expected)
 *         Returns a filter which checks if its argument is like $expected.
 * @method static callable notLike($expected)
 *         Returns a filter whcih check if its argument is not like $expected.
 * @method static callable hasMethodReturning(string $methodName, $expected, bool $strict = true)
 *         Returns a filter which calls $methodName on its argument and checks the result is the same as $expected.
 *         The $strict parameter uses == instead of === is set to Filter::NOT_STRICT.
 * @method static callable notHasMethodReturning(string $methodName, $expected, bool strict = true)
 *         Returns a filter which calls $methodName on its argument and checks the result is not the same as $expected.
 *         The $strict parameter uses == instead of === is set to Filter::NOT_STRICT.
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
