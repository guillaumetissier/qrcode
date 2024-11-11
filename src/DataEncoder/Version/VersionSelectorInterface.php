<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version;

interface VersionSelectorInterface
{
    public function selectVersion($dataLength): Version;
}
