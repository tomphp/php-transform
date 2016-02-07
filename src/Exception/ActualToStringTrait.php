<?php

namespace TomPHP\Transform\Exception;

trait ActualToStringTrait
{
    /**
     * Return human readable string representation of a variable.
     *
     * @param mixed $actual
     *
     * @return string
     */
    private static function actualToString($actual)
    {
        if (is_array($actual)) {
            return 'Array';
        }

        if (is_object($actual)) {
            return 'instance of '.get_class($actual);
        }

        return sprintf('%s', $actual);
    }
}
