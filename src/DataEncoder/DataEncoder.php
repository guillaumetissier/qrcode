<?php

namespace ThePhpGuild\QrCode\DataEncoder;

use ThePhpGuild\Qrcode\DataEncoder\Encoder\EncoderFactory;
use ThePhpGuild\Qrcode\DataEncoder\Mode\ModeResolver;

class DataEncoder
{
    private string $data;
    private int $version;

    public function __construct(
        private readonly ModeResolver   $modeResolver,
        private readonly EncoderFactory $encoderFactory,
        private readonly PaddingAdder   $paddingAdder
    ) {
    }

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function setVersion(int $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function encode(): string
    {
        $mode = $this->modeResolver
            ->setData($this->data)
            ->resolve();

        $encodedData = $this->encoderFactory
            ->getEncoder($mode)
            ->setData($this->data)
            ->encode();

        return $this->paddingAdder
            ->setMode($mode)
            ->setVersion($this->version)
            ->setData($encodedData)
            ->addPadding();
    }
}
