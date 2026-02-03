<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\DataCodewordPlacer;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

interface DataCodewordPositionsInterface
{
    public function withSize(int $size): self;

    /**
     * @return Generator<Position>
     * @throws MissingInfoException
     */
    public function positions(): Generator;
}
