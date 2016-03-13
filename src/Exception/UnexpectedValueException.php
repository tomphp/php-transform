<?php

namespace TomPHP\Transform\Exception;

class UnexpectedValueException extends \UnexpectedValueException implements Exception
{
    use ActualToStringTrait;
    use ExpectedStringTrait;
    use ExpectedObjectTrait;
    use ExpectedStaticMethodTrait;
    use ExpectedPublicMethodTrait;
    use ExpectedMethodTrait;

    private static function buildException($object, $method, $message)
    {
        $object = is_object($object) ? get_class($object) : $object;

        return new self(sprintf(
            '"%s::%s() %s"',
            self::actualToString($object),
            self::actualToString($method),
            $message
        ));
    }
}
