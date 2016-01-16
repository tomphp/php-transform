<?php

namespace TomPHP\Transform\Exception;

class UnexpectedValueException extends \UnexpectedValueException implements Exception
{
    use ActualToStringTrait;
    use ExpectedStringTrait;
    use ExpectedObjectTrait;

    /**
     * @param object|string $object
     * @param string $method
     * @return \TomPHP\Transform\Exception\InvalidArgumentException
     */
    public static function expectedMethod($object, $method)
    {
        is_object($object) and $object = get_class($object);

        return new self(sprintf(
            '"%s::%s() is not a valid method."',
            self::actualToString($object),
            self::actualToString($method)
        ));
    }
}
