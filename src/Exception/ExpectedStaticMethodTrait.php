<?php

namespace TomPHP\Transform\Exception;

trait ExpectedStaticMethodTrait
{
    /**
     * @param object|string $object
     * @param string        $method
     *
     * @return self
     */
    public static function expectedStaticMethod($object, $method)
    {
        return self::buildException($object, $method, 'is not a static method.');
    }
}
