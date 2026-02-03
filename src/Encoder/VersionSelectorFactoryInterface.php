<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder;

use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\VersionSelectorInterface;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Mode;

interface VersionSelectorFactoryInterface
{
    public function getVersionSelector(Mode $mode, ErrorCorrectionLevel $ecl): VersionSelectorInterface;
}
