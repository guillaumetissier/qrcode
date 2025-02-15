<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter;

use ThePhpGuild\QrCode\DataEncoder\Mode\ModeIndicator;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\CciBitsCounterInterface;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\EncodedDataBitsCounterInterface;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class TotalBitsCounter implements CounterInterface
{
    private ?Version $version    = null;
    private ?int     $dataLength = null;

    public function __construct(
        readonly private CciBitsCounterInterface $cciBitsCounter,
        readonly private EncodedDataBitsCounterInterface $encodedDataBitsCounter,
    )
    {
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
        $totalBits = ModeIndicator::GetTotalBits();
        $totalBits += $this->cciBitsCounter->setVersion($this->version)->count();
        $totalBits += $this->encodedDataBitsCounter->setDataLength($this->dataLength)->count();

        return $totalBits;
    }
}
