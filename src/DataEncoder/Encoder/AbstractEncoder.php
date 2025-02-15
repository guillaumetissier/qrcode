<?php

namespace ThePhpGuild\QrCode\DataEncoder\Encoder;

abstract class AbstractEncoder implements EncoderInterface
{
    public function __construct(protected ?string $data = null)
    {
    }

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    abstract public function encode(): string;
}
