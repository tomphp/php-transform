<?php

namespace tests\TomPHP\Transform;

use PHPUnit_Framework_TestCase;
use TomPHP\Transform as T;
use TomPHP\Transform\Exception\InvalidArgumentException;

final class AppendTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_appends_a_string_onto_its_value()
    {
        $fn = T\append(' was here');

        $this->assertSame('Tom was here', $fn('Tom'));
    }

    /** @test */
    public function it_expects_suffix_to_be_a_string()
    {
        $this->setExpectedException(
            InvalidArgumentException::class,
            '$suffix was expected to be a string; got 123'
        );

        T\append(123);
    }
}
