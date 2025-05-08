<?php

namespace ThePhpGuild\QrCode\Step1DataAnalyser\Version\Selector;

use ThePhpGuild\QrCode\Enums\Version;

interface VersionSelectorInterface
{
    public function selectVersion($dataLength): Version;
}
