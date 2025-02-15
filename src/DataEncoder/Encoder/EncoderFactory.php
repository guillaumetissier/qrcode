<?php

namespace ThePhpGuild\QrCode\DataEncoder\Encoder;

use ThePhpGuild\QrCode\DataEncoder\Mode\Mode;

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
