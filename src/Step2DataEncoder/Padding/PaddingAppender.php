<?php

namespace ThePhpGuild\QrCode\Step2DataEncoder\Padding;

use ThePhpGuild\QrCode\Step1DataAnalyser\Mode\Mode;
use ThePhpGuild\QrCode\Step1DataAnalyser\Mode\ModeIndicator;
use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;
use ThePhpGuild\QrCode\Step2DataEncoder\Padding\LengthBits\LengthBitsFactory;
use ThePhpGuild\QrCode\Step2DataEncoder\Padding\TotalBitsCounter\TotalBitsCounterBuilder;

class PaddingAppender
{
    private ?Mode $mode = null;
    private ?Version $version = null;
    private ?string $data = null;

    public function __construct(
        readonly private TotalBitsCounterBuilder $totalBitsCounterBuilder,
        readonly private ModeIndicator $modeIndicator,
        readonly private LengthBitsFactory $lengthBitsFactory
    )
    {
    }

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

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function appendPadding(): string
    {
        $dataLength = strlen($this->data);
        $totalBits = $this->totalBitsCounterBuilder
            ->getTotalBitsCounter($this->mode)
                ->setDataLength($dataLength)
                ->setVersion($this->version)
                ->count();

        $lengthBits = $this->lengthBitsFactory
            ->getLengthBits($this->mode)
                ->setDataLength($dataLength)
                ->setVersion($this->version)
                ->getLengthBits();

        $binaryData = $this->modeIndicator->setMode($this->mode)->getModeIndicator() . $lengthBits . $this->data;
        $binaryData = str_pad($binaryData, $totalBits, '0');

        while (strlen($binaryData) % 8 !== 0) {
            $binaryData .= '0';
        }

        $paddingBytes = ['11101100', '00010001'];
        $i = 0;
        while (strlen($binaryData) < $totalBits) {
            $binaryData .= $paddingBytes[$i % 2];
            $i++;
        }

        return $binaryData;
    }
}