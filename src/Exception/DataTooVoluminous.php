<?php

namespace ThePhpGuild\QrCode\Exception;

class DataTooVoluminous extends \Exception
{
    public function __construct(int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct("Data too voluminous. It cannot be encoded.", $code, $previous);
    }
}
