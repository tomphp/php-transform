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

    /** @test */
    public function it_calls_the_method_with_arguments()
<<<<<<< HEAD
=======
    {
        $fn = T\callMethod('returnArgument', 'argument value');

        $this->assertEquals('argument value', $fn(new CallMethodExample()));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_throws_exception_when_argument_not_string()
>>>>>>> refs/remotes/origin/type-constrain
    {
        $fn = T\callMethod('returnArgument', 'argument value');

        $this->assertEquals('argument value', $fn(new CallMethodExample()));
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
