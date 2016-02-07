<?php

namespace tests\TomPHP\Transform;

use PHPUnit_Framework_TestCase;
use TomPHP\Transform as T;
use TomPHP\Transform\Exception\InvalidArgumentException;
use TomPHP\Transform\Exception\UnexpectedValueException;

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

    /** @test */
    public function it_throws_if_value_is_an_array()
    {
        $this->setExpectedException(
            UnexpectedValueException::class,
            'to be a string'
        );

        $fn = T\append('Mr. ');

        $fn([]);
    }

    /** @test */
    public function it_throws_if_value_is_an_object()
    {
        $this->setExpectedException(
            UnexpectedValueException::class,
            'to be a string'
        );

        $fn = T\append('Mr. ');

        $fn(new \stdClass());
    }

    /** @test */
    public function it_will_prepend_if_the_value_is_a_scalar()
    {
        $fn = T\append('cm');

        $this->assertSame('123cm', $fn(123));
    }

    /** @test */
    public function it_will_prepend_if_the_value_stringable_object()
    {
        $fn = T\append('!');

        $this->assertSame('SHOUT!', $fn(new AppendStringExample('SHOUT')));
    }
}

class AppendStringExample
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
