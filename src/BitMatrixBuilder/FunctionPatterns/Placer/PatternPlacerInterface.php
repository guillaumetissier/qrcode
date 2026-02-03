<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;
use Guillaumetissier\QrCode\Enums\Version;

interface PatternPlacerInterface
{
    public function withVersion(Version $version): self;

    public function place(BitMatrix $matrix, FunctionPatternPositions $functionPatternPositions): void;
}
