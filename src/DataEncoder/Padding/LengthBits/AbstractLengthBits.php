<?php

namespace ThePhpGuild\Qrcode\DataEncoder\Padding\LengthBits;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;

abstract class AbstractLengthBits implements LengthBitsInterface
{
    protected ?int $dataLength = null;
    protected ?Version $version = null;

    public function setDataLength(?int $dataLength): self
    {
        $this->dataLength = $dataLength;

        return $this;
    }

    public function setVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    abstract public function getLengthBits(): string;
}
