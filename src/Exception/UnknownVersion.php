<?php

namespace ThePhpGuild\QrCode\Exception;

class UnknownVersion extends \Exception
{
    public function __construct(int $version, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct("Unknown Version $version", $code, $previous);
    }
}
