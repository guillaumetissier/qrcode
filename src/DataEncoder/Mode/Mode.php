<?php

namespace ThePhpGuild\Qrcode\DataEncoder\Mode;

enum Mode
{
    case NUMERIC;
    case ALPHANUMERIC;
    case BYTE;

    function getValue(): int
    {
        return match ($this) {
            self::NUMERIC => 1,
            self::ALPHANUMERIC => 2,
            self::BYTE => 4
        };
    }

    function getIndicator(): string
    {
        return match ($this) {
            self::NUMERIC => '0001',
            self::ALPHANUMERIC => '0010',
            self::BYTE => '0100'
        };
    }
}
