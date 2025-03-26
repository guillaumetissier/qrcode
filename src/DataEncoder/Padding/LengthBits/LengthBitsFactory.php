<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\LengthBits;

use ThePhpGuild\QrCode\DataEncoder\Mode\Mode;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class LengthBitsFactory
{
    public function __construct(private readonly IOLoggerInterface $logger)
    {
    }

    public function getLengthBits(Mode $mode): LengthBitsInterface
    {
        $lengthBits = match ($mode) {
            Mode::ALPHANUMERIC => new AlphanumericLengthBits(clone $this->logger),
            Mode::BYTE => new ByteLengthBits(clone $this->logger),
            Mode::NUMERIC => new NumericLengthBits(clone $this->logger),
        };

        $this->logger->debug("(Mode:{$mode->value}) => " . $lengthBits::class);

        return $lengthBits;
    }
}
