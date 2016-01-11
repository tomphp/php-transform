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

        $object = new \stdClass();
        $object->name = 'Tom';

        $this->assertSame('Tom', $fn(['name' => 'Tom']));
    }
}
