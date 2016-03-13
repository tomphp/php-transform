<?php

namespace TomPHP\Transform\Exception;

trait ExpectedMethodTrait
{
    /**
     * @param object|string $object
     * @param string        $method
     *
     * @return self
     */
    public static function expectedMethod($object, $method)
    {
        return self::buildException($object, $method, 'is not a valid method.');
    }
}
