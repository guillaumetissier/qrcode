<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Common\VersionDependentTrait;
use Guillaumetissier\QrCode\Enums\Version;

abstract class AbstractPatternPositions implements PatternPositionsInterface
{
    use VersionDependentTrait;

    /**
     * @return Generator<Position>
     */
    abstract public function positions(): Generator;
}
