<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\Common\PositionsInterface;
use Guillaumetissier\QrCode\Enums\FunctionPatternType;

interface PatternPositionsFactoryInterface
{
    public function createPatternPositions(FunctionPatternType $patternType): ?PositionsInterface;
}
