<?php

namespace ThePhpGuild\QrCode\DataEncoder\Mode;

use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

class ModeDetector
{
    private ?string $data = null;

    public function __construct(private readonly LevelFilteredLogger $logger)
    {
    }

    public function setData(?string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function detect(): Mode
    {
        if ($this->isNumeric()) {
            $this->logger->debug("Detected a numeric mode");
            return Mode::NUMERIC;
        }

        if ($this->isAlphanumeric()) {
            $this->logger->debug("Detected a alphanumeric mode");
            return Mode::ALPHANUMERIC;
        }

        $this->logger->debug("Detected a byte mode");
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
