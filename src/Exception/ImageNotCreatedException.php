<?php

namespace ThePhpGuild\QrCode\Exception;

class ImageNotCreatedException extends \Exception
{
    public function __construct(int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct("Image not created", $code, $previous);
    }
}
