<?php

namespace ThePhpGuild\QrCode\Step1DataAnalyser\Version\Selector;

use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;

interface VersionSelectorInterface
{
    public function selectVersion($dataLength): Version;
}
