<?php

namespace tests\TomPHP\Transform;

use PHPUnit_Framework_TestCase;
use function TomPHP\Transform\__;
use TomPHP\Transform\Exception\MethodNotImplementedException;

final class BuildTest extends PHPUnit_Framework_TestCase
{
    /** @var BuilderExample */
    private $example;

    protected function setUp()
    {
        $this->example = new BuilderExample();
    }

    /** @test */
    public function it_builds_a_single_callMethod_transformation()
    {
        $fn = __()->getValue();

        $this->assertSame('method \'getValue\' level1', $fn($this->example));
    }

    /** @test */
    public function it_builds_a_single_callMethod_transformation_with_arguments()
    {
        $fn = __()->getArgument('test argument');

        $this->assertSame('test argument', $fn($this->example));
    }

    /** @test */
    public function it_builds_a_multiple_callMethod_transformation()
    {
        $fn = __()->getChild()->getValue();

        $this->assertSame('method \'getValue\' level2', $fn($this->example));
    }

    /** @test */
    public function it_returns_a_unique_builder_at_each_callMethod_step()
    {
        $step1 = __()->getChild();
        $step2 = $step1->getValue();

        $this->assertNotSame($step1($this->example), $step2($this->example));
    }

    /** @test */
    public function it_builds_a_getProperty_transformation()
    {
        $fn = __()->property;

        $this->assertSame('property \'property\' level1', $fn($this->example));
    }

    /** @test */
    public function it_builds_multiple_level_getProperty_transformation()
    {
        $fn = __()->child->property;

        $this->assertSame('property \'property\' level2', $fn($this->example));
    }

    /** @test */
    public function it_returns_a_unique_builder_at_each_getProperty_step()
    {
        $step1 = __()->child;
        $step2 = $step1->property;

        $this->assertNotSame($step1($this->example), $step2($this->example));
    }

    /** @test */
    public function it_builds_a_getElement_transformation()
    {
        $fn = __()['key'];

        $this->assertSame('value', $fn(['key' => 'value']));
    }

    /** @test */
    public function it_builds_multiple_level_getElement_transformation()
    {
        $fn = __()['user']['name'];

        $this->assertSame('Tom', $fn(['user' => ['name' => 'Tom']]));
    }

    /** @test */
    public function it_returns_a_unique_builder_at_each_getElement_step()
    {
        $step1 = __()['user'];
        $step2 = $step1['name'];

        $example = ['user' => ['name' => 'Tom']];

        $this->assertNotSame($step1($example), $step2($example));
    }

    /** @test */
    public function it_throws_MethodNotImplemented_exception_for_offsetExists()
    {
        $this->setExpectedException(MethodNotImplementedException::class);

        __()->offsetExists(1);
    }

    /** @test */
    public function it_throws_MethodNotImplemented_exception_for_offsetSet()
    {
        $this->setExpectedException(MethodNotImplementedException::class);

        __()->offsetSet(1, 'value');
    }

    /** @test */
    public function it_throws_MethodNotImplemented_exception_for_offsetUnset()
    {
        $this->setExpectedException(MethodNotImplementedException::class);

        __()->offsetUnset(1);
    }
}

final class BuilderExample
{
    /** @var int */
    private $level;

    public function __construct($level = 1)
    {
        $this->level = $level;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function __get($name)
    {
        if ($name === 'child') {
            return new self($this->level + 1);
        }

        return "property '$name' level{$this->level}";
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return "method 'getValue' level{$this->level}";
    }

    /**
     * @return self
     */
    public function getChild()
    {
        return new self($this->level + 1);
    }

    /**
     * @param mixed $argument
     *
     * @return mixed
     */
    public function getArgument($argument)
    {
        return $argument;
    }
}
