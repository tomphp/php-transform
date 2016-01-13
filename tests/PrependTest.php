<?php

namespace tests\TomPHP\Transform;

use PHPUnit_Framework_TestCase;
use TomPHP\Transform as T;
use TomPHP\Transform\Exception\InvalidArgumentException;

final class PrependTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_prepends_a_string_onto_its_value()
    {
        $fn = T\prepend('Mr. ');

        $this->assertSame('Mr. Tom', $fn('Tom'));
    }

    /** @test */
    public function it_expects_prefix_to_be_a_string()
    {
        $this->setExpectedException(
            InvalidArgumentException::class,
            '$prefix was expected to be a string; got 123'
        );

        T\prepend(123);
    }
}
