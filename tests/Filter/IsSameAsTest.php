<?php

namespace tests\TomPHP\Predicate;

use PHPUnit_Framework_TestCase;
use TomPHP\Predicate\Filter;

final class IsSameAsTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_returns_true_if_value_is_the_same_as_the_one_under_test()
    {
        $fn = Filter::isSameAs(101);

        $this->assertTrue($fn(101));
    }

    /** @test */
    public function it_returns_false_if_value_is_not_the_same_as_the_one_under_test()
    {
        $fn = Filter::isSameAs(101);

        $this->assertFalse($fn('one hundred and one'));
    }

    /** @test */
    public function it_returns_false_if_value_is_like_the_one_under_test()
    {
        $fn = Filter::isSameAs(101);

        $this->assertFalse($fn(101.0));
    }

    /** @test */
    public function notSameAs_negates_the_behaviour()
    {
        $fn = Filter::notSameAs(101);

        $this->assertFalse($fn(101), 'same as');
        $this->assertTrue($fn('one hundred and one'), 'different');
        $this->assertTrue($fn(101.0), 'like');
    }
}
