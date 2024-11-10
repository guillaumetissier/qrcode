<?php

namespace ThePhpGuild\QrCode\Exception;

class UnknownMode extends \Exception
{
    public function __construct(int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct('Unknown Mode', $code, $previous);
    }
}
