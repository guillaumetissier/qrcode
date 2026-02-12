<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Exception;

use Guillaumetissier\QrCode\Common\Helper\ClassNameHelper;

final class MissingInfoException extends \Exception
{
    public static function wasNotComputed(string $info, string $class): self
    {
        return new self(sprintf("Info '$info' was not computed. Context: %s.", ClassNameHelper::getClassName($class)));
    }

    public static function missingInfo(string $info, string $class): self
    {
        return new self(sprintf("Info '%s' missing. Context: %s", $info, ClassNameHelper::getClassName($class)));
    }

    private function __construct(string $message)
    {
        parent::__construct($message, ExceptionCode::MISSING_INFO->value);
    }
}
