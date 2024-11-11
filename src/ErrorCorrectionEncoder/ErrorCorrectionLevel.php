<?php

namespace ThePhpGuild\Qrcode\ErrorCorrectionEncoder;

enum ErrorCorrectionLevel
{
    case LOW;
    case MEDIUM;
    case QUARTILE;
    case HIGH;

    public function toString(): string
    {
        return match ($this) {
            ErrorCorrectionLevel::LOW => 'L',
            ErrorCorrectionLevel::MEDIUM => 'M',
            ErrorCorrectionLevel::QUARTILE => 'Q',
            ErrorCorrectionLevel::HIGH => 'H'
        };
    }
}
