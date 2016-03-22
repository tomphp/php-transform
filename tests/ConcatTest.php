<?php

namespace tests\TomPHP\Transform;

use PHPUnit_Framework_TestCase;
use TomPHP\Transform as T;
use TomPHP\Transform\Exception\InvalidArgumentException;
use TomPHP\Transform\Exception\UnexpectedValueException;
use const TomPHP\Transform\__;

final class ConcatTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_concatenates_all_the_arguments_together()
    {
        $fn = T\concat('abc', 'def', 'ghi');

        $this->assertSame('abcdefghi', $fn('xxx'));
    }

    /** @test */
    public function it_inserts_the_value_at_the_placeholder()
    {
        $fn = T\concat('abc', __, 'ghi');

        $this->assertSame('abcDEFghi', $fn('DEF'));
    }
}
