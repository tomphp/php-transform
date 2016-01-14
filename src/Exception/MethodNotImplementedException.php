<?php

namespace TomPHP\Transform\Exception;

use LogicException;

class MethodNotImplementedException extends LogicException implements Exception
{
    /**
     * @param string $class
     *
     * @return self
     */
    public static function arrayAccessReadOnly($class)
    {
        return new self("Array access on $class is read only.");
    }
}
