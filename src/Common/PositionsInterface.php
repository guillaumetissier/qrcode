<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Common;

use Generator;

interface PositionsInterface
{
    /**
     * @return Generator<Position>
     */
    public function positions(): Generator;
}
