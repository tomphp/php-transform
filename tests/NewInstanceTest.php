<?php

namespace tests\TomPHP\Transform;

use PHPUnit_Framework_TestCase;
use TomPHP\Transform as T;
use const TomPHP\Transform\__;
use TomPHP\Transform\Exception\InvalidArgumentException;

final class NewInstanceTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_instantiates_an_object_of_type_class_name()
    {
        $fn = T\newInstance(ClassNewInstanceExample::class);
        $this->assertInstanceOf(ClassNewInstanceExample::class, $fn(null));
    }

    /** @test */
    public function it_instantiates_an_object_with_default_array_arguments()
    {
        $fn = T\newInstance(ClassNewInstanceExample::class);
        $this->assertSame(['test_default'], $fn('test_default')->getExampleArgs());
    }

    /** @test */
    public function it_instantiates_an_object_with_empty_array_arguments()
    {
        $fn = T\newInstance(ClassNewInstanceExample::class, []);
        $this->assertSame(0, count($fn('test_empty_array_arguments')->getExampleArgs()));
    }

    /** @test */
    public function it_instantiates_an_object_with_arguments_and_no_positional_argument()
    {
        $fn = T\newInstance(ClassNewInstanceExample::class, [1, 2, 'str1', 'str2']);
        $this->assertSame([1, 2, 'str1', 'str2'], $fn(null)->getExampleArgs());
    }

    /** @test */
    public function it_instantiates_an_object_with_arguments_and_positional_argument()
    {
        $fn = T\newInstance(ClassNewInstanceExample::class, ['a', 'b', __, [1, 2, 3]]);
        $this->assertSame(['a', 'b', 'test_positional_arg', [1, 2, 3]], $fn('test_positional_arg')->getExampleArgs());
    }

    /** @test */
    public function it_expects_class_name_to_be_a_string()
    {
        $this->setExpectedException(
            InvalidArgumentException::class,
            'className was expected to be a string; got 123.'
        );

        T\newInstance(123);
    }

    /** @test */
    public function it_expects_class_name_to_be_a_valid_class()
    {
        $this->setExpectedException(
            InvalidArgumentException::class,
            'Class InvalidClass does not exist.'
        );

        T\newInstance('InvalidClass');
    }
}

class ClassNewInstanceExample
{
    private $args;
    public function __construct(...$args)
    {
        $this->args = $args;
    }
    public function getExampleArgs()
    {
        return $this->args;
    }
}
