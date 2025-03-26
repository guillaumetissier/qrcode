<?php

namespace ThePhpGuild\QrCode\DataEncoder\Mode;

use ThePhpGuild\QrCode\Exception\UnknownMode;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class ModeIndicator
{
    private ?Mode $mode = null;

    public function __construct(private readonly IOLoggerInterface $logger)
    {
    }

    public static function GetTotalBits(): int
    {
        return 4;
    }

    public function setMode(Mode $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * @throws UnknownMode
     */
    public function getModeIndicator(): string
    {
        if ($this->mode === null) {
            throw new UnknownMode();
        }

        $this->logger->input("Mode = {$this->mode->value}", ['class' => static::class]);

        $modeIndicator = match ($this->mode) {
            Mode::NUMERIC => '0001',
            Mode::ALPHANUMERIC => '0010',
            Mode::BYTE => '0100'
        };

        $this->logger->output("Mode indicator = $modeIndicator");

        return $modeIndicator;
    }
}
