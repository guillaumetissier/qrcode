<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Exception;

final class ColorException extends \Exception
{
    /**
     * @param array<int> $rgb
     */
    public static function cannotAllocateColor(string $colorName, array $rgb): self
    {
        return new self(sprintf("Cannot allocate color: $colorName (%s)", join(', ', $rgb)));
    }

    public static function colorNotFound(string $colorName): self
    {
        return new self("Color '{$colorName}' not found in palette");
    }

    private function __construct(string $message)
    {
        parent::__construct($message, ExceptionCode::COLOR_NOT_FOUND->value);
    }
}
