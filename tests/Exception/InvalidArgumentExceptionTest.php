<?php

namespace tests\TomPHP\Transform\Exception;

use PHPUnit_Framework_TestCase;
use TomPHP\Transform\Exception\Exception;
use TomPHP\Transform\Exception\InvalidArgumentException;

final class InvalidArgumentExceptionTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_is_an_InvalidArgumentException()
    {
        $this->assertInstanceOf(\InvalidArgumentException::class, new InvalidArgumentException());
    }

    /** @test */
    public function it_is_a_transform_package_exception()
    {
        $this->assertInstanceOf(Exception::class, new InvalidArgumentException());
    }

    /** @test */
    public function it_creates_an_exception_for_expected_string_but_got_a_different_scalar_type()
    {
        $exception = InvalidArgumentException::expectedString('param', 101);

        $this->assertEquals(
            '$param was expected to be a string; got 101.',
            $exception->getMessage()
        );
    }

    /** @test */
    public function it_creates_an_exception_for_expected_string_but_got_an_object()
    {
        $exception = InvalidArgumentException::expectedString('param', new \stdClass());

        $this->assertEquals(
            '$param was expected to be a string; got instance of stdClass.',
            $exception->getMessage()
        );
    }
}
