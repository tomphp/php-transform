<?php

namespace tests\TomPHP\Predicate;

use PHPUnit_Framework_TestCase;
use TomPHP\Predicate\Filter;

final class HasMethodReturningTest extends PHPUnit_Framework_TestCase
{
    const VALUE           = 99;
    const LIKE_VALUE      = 99.0;
    const DIFFERENT_VALUE = 'a string';

    /** @test */
    public function it_returns_true_if_value_is_the_same_as_the_one_returned()
    {
        $fn = Filter::hasMethodReturning('getValue', self::VALUE);

        $this->assertTrue($fn(new MethodReturning(self::VALUE)));
    }

    /** @test */
    public function it_returns_false_if_value_is_not_the_same_as_the_one_returned()
    {
        $fn = Filter::hasMethodReturning('getValue', self::VALUE);

        $this->assertFalse($fn(new MethodReturning(self::DIFFERENT_VALUE)));
    }

    /** @test */
    public function it_returns_false_if_value_like_the_one_returned()
    {
        $fn = Filter::hasMethodReturning('getValue', self::VALUE);

        $this->assertFalse($fn(new MethodReturning(self::LIKE_VALUE)));
    }

    /** @test */
    public function it_returns_true_if_value_like_the_one_returned_in_NOT_STRICT_mode()
    {
        $fn = Filter::hasMethodReturning('getValue', self::VALUE, Filter::NOT_STRICT);

        $this->assertTrue($fn(new MethodReturning(self::LIKE_VALUE)));
    }

    /** @test */
    public function notHasMethodReturning_negates_the_behaviour()
    {
        $fn = Filter::notHasMethodReturning('getValue', self::VALUE);

        $this->assertFalse($fn(new MethodReturning(self::VALUE)), 'same as');
        $this->assertTrue($fn(new MethodReturning(self::DIFFERENT_VALUE)), 'different');
        $this->assertTrue($fn(new MethodReturning(self::LIKE_VALUE)), 'like');
    }
}

class MethodReturning
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}
