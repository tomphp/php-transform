<?php

namespace tests\TomPHP\Transform;

use PHPUnit_Framework_TestCase;
use TomPHP\Transform as T;

final class CallMethodTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_calls_the_method_and_returns_the_value()
    {
        $fn = T\callMethod('getValue');

        $this->assertSame(123, $fn(new CallMethodExample(123)));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_throws_exception_when_argument_not_string()
    {
        T\callMethod(1);
    }
}

class CallMethodExample
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}
