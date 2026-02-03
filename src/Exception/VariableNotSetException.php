<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Exception;

final class VariableNotSetException extends \Exception
{
    public function __construct(string $variableName)
    {
        parent::__construct("$variableName has not been set", ExceptionCode::VARIABLE_NOT_SET->value);
    }
}
