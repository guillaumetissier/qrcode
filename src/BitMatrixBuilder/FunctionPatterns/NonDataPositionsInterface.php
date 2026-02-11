<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns;

use Guillaumetissier\QrCode\Common\Position;

interface NonDataPositionsInterface
{
    public function addPosition(Position $position): self;

    public function isAFunctionPatternPosition(Position $position): bool;
}
