<?php

namespace tests\TomPHP\Predicate;

use PHPUnit_Framework_TestCase;
use TomPHP\Predicate\Transform;

final class CallMethodTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_calls_the_method_and_returns_the_value()
    {
        $fn = Transform::callMethod('getValue');

        $this->assertSame(123, $fn(new MethodReturning(123)));
    }
}

class CallMethod
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
