<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;

interface VersionSelectorInterface
{
    public function selectVersion($dataLength): Version;
}
