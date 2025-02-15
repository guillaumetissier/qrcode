<?php

namespace ThePhpGuild\Qrcode\DataEncoder\Mode;

class ModeIndicator
{
    private ?Mode $mode = null;

    public static function GetTotalBits(): int
    {
        return 4;
    }

    public function setMode(Mode $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function getModeIndicator(): string
    {
        return match ($this->mode) {
            Mode::NUMERIC => '0001',
            Mode::ALPHANUMERIC => '0010',
            Mode::BYTE => '0100'
        };
    }
}
