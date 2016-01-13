<?php

namespace tests\TomPHP\Transform;

use PHPUnit_Framework_TestCase;
use TomPHP\Transform as T;

final class GetPropertyTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_returns_value_of_the_named_array_entry()
    {
        $fn = T\getProperty('name');

        $this->assertSame('Tom', $fn(['name' => 'Tom']));
    }

    /** @test */
    public function it_returns_value_of_a_nested_array_entry()
    {
        $fn = T\getProperty(['user', 'name']);

        $this->assertSame('Tom', $fn(['user' => ['name' => 'Tom']]));
    }

    /** @test */
    public function it_returns_property_of_the_object_entry()
    {
        $fn = T\getProperty('name');

        $this->assertSame('Tom', $fn((object) ['name' => 'Tom']));
    }

    /** @test */
    public function it_returns_property_of_the_array_access_entry()
    {
        $fn = T\getProperty('name');

        $this->assertSame('Tom', $fn(new \ArrayObject(['name' => 'Tom'])));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_throws_exception_when_scalar_entry()
    {
        $fn = T\getProperty('name');

        $this->assertSame('Tom', $fn('name'));
    }
}
