<?php

namespace TomPHP\Transform\Exception;

class InvalidArgumentException extends \InvalidArgumentException implements Exception
{
    /**
     * @param string $variable
     * @param mixed  $actual
     *
     * @return self
     */
    public static function expectedString($variable, $actual)
    {
        return new self(sprintf(
            '$%s was expected to be a string; got %s',
            $variable,
            is_object($actual) ? get_class($actual) : $actual
        ));
    }
}
