<?php

namespace ThePhpGuild\Qrcode\DataEncoder;

class ModeResolver
{
    private ?string $data = null;

    public function setData(?string $data): self
    {
        $this->data = $data;

        return $this;
    }

    function resolve(): Mode
    {
        if ($this->isNumeric()) {
            return Mode::NUMERIC;
        }

        if ($this->isAlphanumeric()) {
            return Mode::ALPHANUMERIC;
        }

        return Mode::BYTE;
    }

    private function isNumeric(): bool
    {
        return ctype_digit($this->data);
    }

    private function isAlphanumeric(): bool
    {
        return preg_match('#^[0-9A-Z $%*+\-./:]*$#', $this->data);
    }
}
