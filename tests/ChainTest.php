<?php

namespace tests\TomPHP\Transform;

use PHPUnit_Framework_TestCase;
use TomPHP\Transform as T;

final class ChainTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_produces_a_composit_function()
    {
        $fn1 = function ($value) {
            return $value + 1;
        };

        $fn2 = function ($value) {
            return $value * 2;
        };

        $fn = T\chain($fn1, $fn2);

        $this->assertSame(4, $fn(1));
    }
}
