<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataSplitter;

use Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks\CodewordBlocksInterface;
use Guillaumetissier\QrCode\Enums\Version;

interface CodewordBlocksFactoryInterface
{
    public function getCodewordBlocks(Version $version): CodewordBlocksInterface;
}
