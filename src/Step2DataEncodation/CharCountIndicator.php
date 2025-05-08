<?php

namespace ThePhpGuild\QrCode\Step2DataEncodation;

use ThePhpGuild\QrCode\Enums\Mode;
use ThePhpGuild\QrCode\Enums\Version;

class CharCountIndicator implements BitsStringInterface
{
    private ?Mode $mode = null;

    private ?Version $version = null;

    private ?int $charCount = null;

    public function setMode(Mode $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function setVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function setCharCount(int $charCount): self
    {
        $this->charCount = $charCount;

        return $this;
    }

    public function __toString(): string
    {
        return str_pad(decbin($this->charCount), $this->bitsCount(), '0', STR_PAD_LEFT);
    }

    public function bitsCount(): int
    {
        if ($this->version->value <= 9) {
            return [
                Mode::NUMERIC->value => 10,
                Mode::ALPHANUMERIC->value => 9,
                Mode::BYTE->value => 8
            ][$this->mode->value];
        }

        if ($this->version->value <= 26) {
            return [
                Mode::NUMERIC->value => 12,
                Mode::ALPHANUMERIC->value => 11,
                Mode::BYTE->value => 16
            ][$this->mode->value];
        }

        return [
            Mode::NUMERIC->value => 14,
            Mode::ALPHANUMERIC->value => 13,
            Mode::BYTE->value => 16
        ][$this->mode->value];
    }
}
