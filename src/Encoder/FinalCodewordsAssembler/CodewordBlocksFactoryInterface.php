<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler;

use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks\CodewordBlocksInterface;
use Guillaumetissier\QrCode\Enums\Version;

interface CodewordBlocksFactoryInterface
{
    public function getCodewordBlocks(Version $version): CodewordBlocksInterface;
}
