<?php

namespace ThePhpGuild\QrCode\Exception;

class InvalidOutputOptions extends \Exception
{
    public function __construct(int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct('Invalid output options', $code, $previous);
    }
}
