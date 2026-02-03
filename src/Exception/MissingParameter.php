<?php

namespace Guillaumetissier\QrCode\Exception;

class MissingParameter extends \Exception
{
    public static function missingParameter(string $parameter, string $class): self
    {
        return new self("Parameter '$parameter' missing in class $class");
    }

    private function __construct(string $message)
    {
        parent::__construct($message, ExceptionCode::MISSING_PARAMETER->value);
    }
}
