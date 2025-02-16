<?php

namespace ThePhpGuild\QrCode\Exception;

class UnhandledFileTypeException extends \Exception
{
    public function __construct(string $extension, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct("Unhandled file type $extension", $code, $previous);
    }
}
