<?php

namespace TomPHP\Transform\Exception;

trait ExpectedPublicMethodTrait
{
    /**
     * @param object|string $object
     * @param string        $method
     *
     * @return self
     */
    public static function expectedPublicMethod($object, $method)
    {
        return self::buildException($object, $method, 'is not a public method.');
    }
}
