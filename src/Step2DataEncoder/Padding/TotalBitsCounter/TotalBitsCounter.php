<?php

namespace ThePhpGuild\QrCode\Step2DataEncoder\Padding\TotalBitsCounter;

use ThePhpGuild\QrCode\Step1DataAnalyser\Mode\ModeIndicator;
use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;
use ThePhpGuild\QrCode\Step2DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\CciBitsCounterInterface;
use ThePhpGuild\QrCode\Step2DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\EncodedDataBitsCounterInterface;

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
