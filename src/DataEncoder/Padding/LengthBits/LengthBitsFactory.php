<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\LengthBits;

use ThePhpGuild\QrCode\DataEncoder\Mode\Mode;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

class LengthBitsFactory
{
    public function __construct(private readonly LevelFilteredLogger $logger)
    {
        $this->logger->setPrefix(self::class);
    }

    public function getLengthBits(Mode $mode): LengthBitsInterface
    {
        $lengthBits = match ($mode) {
            Mode::ALPHANUMERIC => new AlphanumericLengthBits(clone $this->logger),
            Mode::BYTE => new ByteLengthBits(clone $this->logger),
            Mode::NUMERIC => new NumericLengthBits(clone $this->logger),
        };

        $this->logger->debug('Output >> Length bits: ' . $lengthBits::class);

        return $lengthBits;
    }
}
