<?php

namespace ThePhpGuild\Qrcode\DataEncoder\Encoder;

use ThePhpGuild\Qrcode\DataEncoder\Mode;

class EncoderFactory
{
    function getEncoder(Mode $mode): EncoderInterface
    {
        return match ($mode) {
            Mode::NUMERIC => new NumericEncoder(),
            Mode::ALPHANUMERIC => new AlphanumericEncoder(),
            Mode::BYTE => new ByteEncoder()
        };
    }
}
