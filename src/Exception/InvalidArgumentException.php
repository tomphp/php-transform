<?php

namespace TomPHP\Transform\Exception;

class InvalidArgumentException extends \InvalidArgumentException implements Exception
{
    use ActualToStringTrait;
    use ExpectedStringTrait;
    use ExpectedObjectTrait;
}
