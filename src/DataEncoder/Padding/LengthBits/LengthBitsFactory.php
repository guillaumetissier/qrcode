<?php

namespace ThePhpGuild\Qrcode\DataEncoder\Padding\LengthBits;

use ThePhpGuild\Qrcode\DataEncoder\Mode\Mode;

class LengthBitsFactory
{
    public function getLengthBits(Mode $mode): LengthBitsInterface
    {
        return match ($mode) {
            Mode::ALPHANUMERIC => new AlphanumericLengthBits(),
            Mode::BYTE => new ByteLengthBits(),
            Mode::NUMERIC => new NumericLengthBits(),
        };
    }
}
