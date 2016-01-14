<?php

namespace tests\TomPHP\Transform\Exception;

use LogicException;
use PHPUnit_Framework_TestCase;
use TomPHP\Transform\Exception\Exception;
use TomPHP\Transform\Exception\MethodNotImplementedException;

final class MethodNotImplementedExceptionTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_is_a_LogicExceptionException()
    {
        $this->assertInstanceOf(LogicException::class, new MethodNotImplementedException());
    }

    /** @test */
    public function it_is_a_transform_package_exception()
    {
        $this->assertInstanceOf(Exception::class, new MethodNotImplementedException());
    }

    /** @test */
    public function it_creates_an_exception_for_array_access_read_mode()
    {
        $exception = MethodNotImplementedException::arrayAccessReadOnly('ClassName');

        $this->assertEquals(
            'Array access on ClassName is read only.',
            $exception->getMessage()
        );
    }
}
