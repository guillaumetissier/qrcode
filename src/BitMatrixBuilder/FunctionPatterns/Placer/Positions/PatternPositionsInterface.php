<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Enums\Version;

interface PatternPositionsInterface
{
    public function positions(): Generator;

    public function withVersion(Version $version): self;
}
