<?php

namespace TomPHP\Transform\Exception;


trait ExpectedStringTrait
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
            '$%s was expected to be a string; got %s.',
            $variable,
            self::actualToString($actual)
        ));
    }
}