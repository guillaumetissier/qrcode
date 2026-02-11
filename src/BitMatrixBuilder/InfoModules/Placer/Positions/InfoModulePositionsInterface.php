<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;

interface InfoModulePositionsInterface
{
    /**
     * @return Generator<Position>
     */
    public function positions(): Generator;

    public function withVersion(Version $version): self;
}
