<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector;

use Guillaumetissier\QrCode\Enums\Version;

interface VersionSelectorInterface
{
    public function selectVersion(int $dataLength): Version;
}
