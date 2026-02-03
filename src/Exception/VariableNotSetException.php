<?php

namespace Guillaumetissier\QrCode\Exception;

class VariableNotSetException extends \Exception
{
    public function __construct(string $variableName)
    {
        parent::__construct("$variableName has not been set", ExceptionCode::VARIABLE_NOT_SET->value);
    }
}
