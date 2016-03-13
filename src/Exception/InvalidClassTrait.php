<?php

namespace TomPHP\Transform\Exception;

trait InvalidClassTrait
{
    /**
     * @param string $invalidClassName
     *
     * @return self
     */
    public static function expectedValidClassName($invalidClassName)
    {
        return new self(sprintf('Class %s does not exist.', $invalidClassName));
    }
}
