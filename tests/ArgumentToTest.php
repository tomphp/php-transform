<?php

namespace tests\TomPHP\Transform;

use PHPUnit_Framework_TestCase;
use TomPHP\Transform as T;

final class ArgumentToTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_calls_a_function_by_name_with_the_value_as_an_argument_and_returns_the_result()
    {
        $fn = T\argumentTo('strtolower');

        $this->assertSame('tom', $fn('Tom'));
    }

    /** @test */
    public function it_calls_a_function_with_the_value_as_an_argument_and_returns_the_result()
    {
        $fn = T\argumentTo(function ($value) {
            return $value + 1;
        });

        $this->assertSame(5, $fn(4));
    }

    /** @test */
    public function it_calls_an_object_method_with_the_value_as_an_argument_and_returns_the_result()
    {
        $fn = T\argumentTo([$this, 'decrement']);

        $this->assertSame(3, $fn(4));
    }

    /** @test */
    public function it_calls_a_static_method_with_the_value_as_an_argument_and_returns_the_result()
    {
        $fn = T\argumentTo([__CLASS__, 'staticDecrement']);

        $this->assertSame(3, $fn(4));
    }

    /**
     * @param int $value
     *
     * @return int
     */
    public function decrement($value)
    {
        return $value - 1;
    }

    /**
     * @param int $value
     *
     * @return int
     */
    public static function staticDecrement($value)
    {
        return $value - 1;
    }
}
