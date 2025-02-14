<?php

namespace ThePhpGuild\Qrcode\Exception;

class NoDataException extends \Exception
{
    public function __construct(int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct('No data', $code, $previous);
    }
}
