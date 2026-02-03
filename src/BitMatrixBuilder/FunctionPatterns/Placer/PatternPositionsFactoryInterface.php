<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\PatternPositionsInterface;
use Guillaumetissier\QrCode\Enums\FunctionPatternType;

interface PatternPositionsFactoryInterface
{
    public function createPatternPositions(FunctionPatternType $patternType): PatternPositionsInterface;
}
