<?php

namespace TomPHP\Transform;

use ArrayAccess;
use TomPHP\Transform\Exception\MethodNotImplementedException;

final class Builder implements ArrayAccess
{
    /** @var callable[] */
    private $transforms = [];

    /**
     * @param string $name
     * @param array  $args
     *
     * @return self
     */
    public function __call($name, $args)
    {
        $new = clone $this;
        $new->transforms[] = callMethod($name, ...$args);

        return $new;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function __get($name)
    {
        $new = clone $this;
        $new->transforms[] = getProperty($name);

        return $new;
    }

    /**
     * @internal
     *
     * @param mixed $offset
     *
     * @throws MethodNotImplementedException
     */
    public function offsetExists($offset)
    {
        throw MethodNotImplementedException::arrayAccessReadOnly(__CLASS__);
    }

    /**
     * @param mixed $offset
     *
     * @return \Closure
     */
    public function offsetGet($offset)
    {
        $new = clone $this;
        $new->transforms[] = getElement($offset);

        return $new;
    }

    /**
     * @internal
     *
     * @param mixed $offset
     * @param mixed $value
     *
     * @throws MethodNotImplementedException
     */
    public function offsetSet($offset, $value)
    {
        throw MethodNotImplementedException::arrayAccessReadOnly(__CLASS__);
    }

    /**
     * @internal
     *
     * @param mixed $offset
     *
     * @throws MethodNotImplementedException
     */
    public function offsetUnset($offset)
    {
        throw MethodNotImplementedException::arrayAccessReadOnly(__CLASS__);
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function __invoke($value)
    {
        $fn = chain(...$this->transforms);

        return $fn($value);
    }
}
