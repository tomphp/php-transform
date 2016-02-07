<?php

namespace tests\TomPHP\Transform\Exception;

use PHPUnit_Framework_TestCase;
use TomPHP\Transform\Exception\Exception;
use TomPHP\Transform\Exception\UnexpectedValueException;

final class UnexpectedValueExceptionTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_is_an_UnexpectedValueException()
    {
        $this->assertInstanceOf(\UnexpectedValueException::class, new UnexpectedValueException());
    }

    /** @test */
    public function it_is_a_transform_package_exception()
    {
        $this->assertInstanceOf(Exception::class, new UnexpectedValueException());
    }
}
