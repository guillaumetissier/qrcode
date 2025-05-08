<?php

namespace ThePhpGuild\QrCode\BitsString;

use ThePhpGuild\QrCode\Enums\Mode;
use ThePhpGuild\QrCode\Exception\UnknownMode;

class ModeIndicator implements BitsStringInterface
{
    private ?Mode $mode = null;

    public function setMode(Mode $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * @throws UnknownMode
     */
    public function __toString(): string
    {
        if ($this->mode === null) {
            throw new UnknownMode();
        }

        return match ($this->mode) {
            Mode::NUMERIC => '0001',
            Mode::ALPHANUMERIC => '0010',
            Mode::BYTE => '0100'
        };
    }

    public function bitsCount(): int
    {
        return 4;
    }
}
