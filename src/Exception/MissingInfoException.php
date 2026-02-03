<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Exception;

final class MissingInfoException extends \Exception
{
    public static function wasNotComputed(string $info, string $class): self
    {
        return new self("Info '$info' was not computed. Context: $class'.");
    }

    public static function missingInfo(string $parameter, string $class): self
    {
        return new self("Info '$parameter' missing. Context: $class");
    }

    private function __construct(string $message)
    {
        parent::__construct($message, ExceptionCode::MISSING_INFO->value);
    }
}
