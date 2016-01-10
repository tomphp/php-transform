<?php

namespace tests\TomPHP\Predicate;

use PHPUnit_Framework_TestCase;
use TomPHP\Predicate\Filter;

final class IsNullTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_returns_true_if_value_is_null()
    {
        $fn = Filter::isNull();

        $this->assertTrue($fn(null));
    }

    /** @test */
    public function it_returns_false_if_value_is_null()
    {
        $fn = Filter::isNull();

        $this->assertFalse($fn(5));
    }

    /** @test */
    public function notNull_negates_the_behaviour()
    {
        $fn = Filter::notNull();

        $this->assertFalse($fn(null));
        $this->assertTrue($fn(5));
    }
}
