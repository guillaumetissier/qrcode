<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;

abstract class AbstractPatternPositions implements PatternPositionsInterface
{
    protected ?Version $version = null;

    public function withVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return Generator<Position>
     */
    abstract public function positions(): Generator;
}
