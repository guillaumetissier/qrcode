<?php

namespace ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter;

use ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\CciBitsCounterInterface;
use ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\EncodedDataBitsCounterInterface;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class TotalBitsCounter implements CounterInterface
{
    protected ?Version $version    = null;
    protected ?int     $dataLength = null;

    public function __construct(
        readonly private CciBitsCounterInterface $cciBitsCounter,
        readonly private EncodedDataBitsCounterInterface $encodedDataBitsCounter,
    )
    {
    }

    public function getVersion(): ?Version
    {
        return $this->version;
    }

    public function setVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function setDataLength(int $dataLength): self
    {
        $this->dataLength = $dataLength;

        return $this;
    }

    public function count(): int
    {
        $totalBits = 4; // Mode Indicator
        $totalBits += $this->cciBitsCounter->setVersion($this->version)->count();
        $totalBits += $this->encodedDataBitsCounter->setDataLength($this->dataLength)->count();

        return $totalBits;
    }
}
