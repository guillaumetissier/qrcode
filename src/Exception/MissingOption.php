<?php

namespace ThePhpGuild\QrCode\Exception;

class MissingOption extends \Exception
{
    public function __construct(string $option, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct("Missing option $option", $code, $previous);
    }
}
