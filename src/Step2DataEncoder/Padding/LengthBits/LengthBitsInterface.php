<?php

namespace ThePhpGuild\QrCode\Step2DataEncoder\Padding\LengthBits;

use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;

interface LengthBitsInterface
{
    public function setDataLength(int $dataLength): self;

    public function setVersion(Version $version): self;

    public function getLengthBits(): string;
}
