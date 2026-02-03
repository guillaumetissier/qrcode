<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder;

use Guillaumetissier\QrCode\Enums\FunctionPatternType;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\PatternPlacerInterface;

interface PatternPlacerFactoryInterface
{
    public function createPatternPlacer(FunctionPatternType $patternType): PatternPlacerInterface;
}
