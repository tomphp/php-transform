<?php

namespace tests\TomPHP\Transform;

use PHPUnit_Framework_TestCase;
use TomPHP\Transform as T;
use TomPHP\Transform\Exception\InvalidArgumentException;
use TomPHP\Transform\Exception\UnexpectedValueException;

final class PrependTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_expects_prefix_to_be_a_string()
    {
        $this->setExpectedException(
            InvalidArgumentException::class,
            '$prefix was expected to be a string; got 123'
        );

        T\prepend(123);
    }

    /** @test */
    public function it_prepends_a_string_onto_its_value()
    {
        $fn = T\prepend('Mr. ');

        $this->assertSame('Mr. Tom', $fn('Tom'));
    }

    /** @test */
    public function it_throws_if_value_is_an_array()
    {
        $this->setExpectedException(
            UnexpectedValueException::class,
            'to be a string'
        );

        $fn = T\prepend('Mr. ');

        $fn([]);
    }

    /** @test */
    public function it_throws_if_value_is_an_object()
    {
        $this->setExpectedException(
            UnexpectedValueException::class,
            'to be a string'
        );

        $fn = T\prepend('Mr. ');

        $fn(new \stdClass());
    }

    /** @test */
    public function it_will_prepend_if_the_value_is_a_scalar()
    {
        $fn = T\prepend('No. ');

        $this->assertSame('No. 123', $fn(123));
    }

    /** @test */
    public function it_will_prepend_if_the_value_stringable_object()
    {
        $fn = T\prepend('Mr. ');

        $this->assertSame('Mr. Oram', $fn(new PrependStringExample('Oram')));
    }
}

class PrependStringExample
{
    /** @var string */
    private $string;

    /** @param string $string */
    public function __construct($string)
    {
        $this->string = $string;
    }

    public function __toString()
    {
        return $this->string;
    }
}
