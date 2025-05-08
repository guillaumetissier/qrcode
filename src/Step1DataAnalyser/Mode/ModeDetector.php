<?php

namespace ThePhpGuild\QrCode\Step1DataAnalyser\Mode;

use ThePhpGuild\QrCode\Enums\Mode;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class ModeDetector
{
    private ?string $data = null;

    public function __construct(private readonly IOLoggerInterface $logger)
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
            $this->logger->output("Mode = NUMERIC", ['class' => static::class]);
            return Mode::NUMERIC;
        }

        if ($this->isAlphanumeric()) {
            $this->logger->output("Mode = ALPHANUMERIC", ['class' => static::class]);
            return Mode::ALPHANUMERIC;
        }

        $this->logger->output("Mode = BYTE", ['class' => static::class]);
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
