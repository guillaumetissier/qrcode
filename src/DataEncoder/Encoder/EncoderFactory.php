<?php

namespace ThePhpGuild\QrCode\DataEncoder\Encoder;

use ThePhpGuild\QrCode\DataEncoder\Mode\Mode;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

class EncoderFactory
{
    public function __construct(private readonly LevelFilteredLogger $logger)
    {
    }

    public function getEncoder(Mode $mode): EncoderInterface
    {
        return match ($mode) {
            Mode::NUMERIC => new NumericEncoder($this->logger),
            Mode::ALPHANUMERIC => new AlphanumericEncoder($this->logger),
            Mode::BYTE => new ByteEncoder($this->logger),
        };
    }
}
