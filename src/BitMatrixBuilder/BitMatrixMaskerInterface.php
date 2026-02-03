<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;

interface BitMatrixMaskerInterface
{
    public function withFunctionPatternPositions(FunctionPatternPositions $functionPositions): self;

    public function mask(BitMatrix $matrix): array;
}
