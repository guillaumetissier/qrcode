<?php

namespace ThePhpGuild\QrCode\Step2DataEncoder\Padding\LengthBits;

use ThePhpGuild\QrCode\Step1DataAnalyser\Mode\Mode;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class LengthBitsFactory
{
    public function __construct(private readonly IOLoggerInterface $logger)
    {
    }

    public function getLengthBits(Mode $mode): LengthBitsInterface
    {
        $this->logger->input("Mode = {$mode->value}", ['class' => static::class]);

        $lengthBits = match ($mode) {
            Mode::ALPHANUMERIC => new AlphanumericLengthBits($this->logger),
            Mode::BYTE => new ByteLengthBits($this->logger),
            Mode::NUMERIC => new NumericLengthBits($this->logger),
        };

        $this->logger->output("Creation of " . $lengthBits::class, ['class' => static::class]);

        return $lengthBits;
    }
}
