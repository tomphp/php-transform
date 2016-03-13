<?php

namespace tests\TomPHP\Transform;

use PHPUnit_Framework_TestCase;
use TomPHP\Transform\Exception\InvalidArgumentException;
use TomPHP\Transform\Exception\UnexpectedValueException;
use TomPHP\Transform as T;

final class CallStaticTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_calls_the_static_method_and_returns_the_value()
    {
        $fn = T\callStatic('method', 'a', false, 42);

        $this->assertSame(['a', false, 42], $fn(new CallStaticExample()));
    }

    /** @test */
    public function it_supports_classes_as_strings()
    {
        $fn = T\callStatic('method', 'a', false, 42);

        $this->assertSame(['a', false, 42], $fn(CallStaticExample::class));
    }

    /** @test */
    public function it_throws_exception_if_class_is_not_found()
    {
        $fn = T\callStatic('method', 'a', false, 42);
        $this->setExpectedException(
            InvalidArgumentException::class,
            'Class ThereIsNotClassLikeThat does not exist.'
        );
        $fn('ThereIsNotClassLikeThat');
    }

    /** @test */
    public function it_throws_exception_if_method_name_is_not_a_string()
    {
        $this->setExpectedException(
            InvalidArgumentException::class,
            'expected to be a string'
        );

        T\callStatic(42);
    }

    /** @test */
    public function it_throws_exception_if_method_is_not_found()
    {
        $fn = T\callStatic('doesNotExist');

        $this->setExpectedException(
            UnexpectedValueException::class,
            'is not a valid method'
        );

        $fn(new CallStaticExample());
    }

    /** @test */
    public function it_throws_exception_if_method_is_not_static()
    {
        $fn = T\callStatic('methodWhichIsNotStatic');

        $this->setExpectedException(
            UnexpectedValueException::class,
            'is not a static method'
        );

        $fn(new CallStaticExample());
    }

    /** @test */
    public function it_throws_exception_if_method_is_not_public()
    {
        $fn = T\callStatic('protectedMethod');

        $this->setExpectedException(
            UnexpectedValueException::class,
            'is not a public method'
        );

        $fn(new CallStaticExample());
    }
}

class CallStaticExample
{
    public static function method(...$arguments)
    {
        return $arguments;
    }

    public function methodWhichIsNotStatic()
    {
    }

    protected static function protectedMethod()
    {
    }
}
