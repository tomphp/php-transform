<?php

namespace TomPHP\Transform\Exception;


trait ExpectedObjectTrait
{

    /**
     * @param string $variable
     * @param mixed  $actual
     *
     * @return self
     */
    public static function expectedObject($variable, $actual)
    {
        return new self(sprintf(
            '$%s was expected to be an object; got %s.',
            $variable,
            self::actualToString($actual)
        ));
    }
}