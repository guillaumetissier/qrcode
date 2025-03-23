<?php

namespace ThePhpGuild\QrCode\Exception;

class WrongValue extends \Exception
{
    public function __construct(string $variable, string $value, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct("Wrong value ($value) for $variable", $code, $previous);
    }
}
