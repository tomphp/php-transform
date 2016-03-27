<?php

namespace tests\TomPHP\Transform;

use PHPUnit_Framework_TestCase;
use TomPHP\Transform as T;

final class ValueOrDefaultTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_returns_value_if_it_is_not_null_and_no_predicate_is_supplied()
    {
        $fn = T\valueOrDefault('default');

        $this->assertSame('value', $fn('value'));
    }

    /** @test */
    public function it_returns_default_if_value_is_null_and_no_predicate_is_supplied()
    {
        $fn = T\valueOrDefault('default');

        $this->assertSame('default', $fn(null));
    }

    /** @test */
    public function it_returns_default_if_a_predicate_is_supplied_and_it_returns_false()
    {
        $predicate = function ($value) {
            return $value === 'success';
        };

        $fn = T\valueOrDefault('default', $predicate);

        $this->assertSame('default', $fn('fail'));
    }

    /** @test */
    public function it_returns_value_if_a_predicate_is_supplied_and_it_returns_true()
    {
        $predicate = function ($value) {
            return $value === 'success';
        };

        $fn = T\valueOrDefault('default', $predicate);

        $this->assertSame('success', $fn('success'));
    }
}
