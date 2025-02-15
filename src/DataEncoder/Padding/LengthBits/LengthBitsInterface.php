<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\LengthBits;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;

interface LengthBitsInterface
{
    public function setDataLength(int $dataLength): self;

    public function setVersion(Version $version): self;

    public function getLengthBits(): string;
}
