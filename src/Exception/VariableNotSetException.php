<?php

namespace ThePhpGuild\QrCode\Exception;

class VariableNotSetException extends \Exception
{
    public function __construct(string $variableName, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct("$variableName has not been set", $code, $previous);
    }
}
