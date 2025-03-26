<?php

namespace ThePhpGuild\QrCode\DataEncoder\Encoder;

use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

abstract class AbstractEncoder implements EncoderInterface
{
    protected ?string $data = null;

    public function __construct(protected readonly IOLoggerInterface $logger)
    {
    }

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    abstract public function encode(): string;
}
