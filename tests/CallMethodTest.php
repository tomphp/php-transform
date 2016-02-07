<?php

namespace tests\TomPHP\Transform;

use PHPUnit_Framework_TestCase;
use TomPHP\Transform as T;
use TomPHP\Transform\Exception\InvalidArgumentException;
use TomPHP\Transform\Exception\UnexpectedValueException;

final class CallMethodTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_throws_if_the_method_name_is_not_a_string_when_creating_the_transformer()
    {
        $this->setExpectedException(
            InvalidArgumentException::class,
            'expected to be a string'
        );

        T\callMethod([]);
    }

    /** @test */
    public function it_calls_the_method_and_returns_the_value()
    {
        $fn = T\callMethod('getValue');

        $this->assertSame(123, $fn(new CallMethodExample(123)));
    }

    /** @test */
    public function it_calls_the_method_with_arguments()
    {
        $fn = T\callMethod('returnArgument', 'argument value');

        $this->assertEquals('argument value', $fn(new CallMethodExample()));
    }

    /** @test */
    public function it_throws_if_the_transformer_is_not_passed_an_object()
    {
        $fn = T\callMethod('getValue');

        $this->setExpectedException(
            UnexpectedValueException::class,
            'to be an object'
        );

        $fn('not an object');
    }

    /** @test */
    public function it_throws_the_method_does_not_exist()
    {
        $fn = T\callMethod('doesNotExist');

        $this->setExpectedException(
            UnexpectedValueException::class,
            'is not a valid method'
        );

        $fn(new CallMethodExample());
    }
}

class CallMethodExample
{
    private $value;

    public function __construct($value = null)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function returnArgument($argument)
    {
        return $argument;
    }
}
