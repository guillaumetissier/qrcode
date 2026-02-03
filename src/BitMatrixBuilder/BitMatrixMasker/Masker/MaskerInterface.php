<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;

interface MaskerInterface
{
    public function withFunctionPatternPositions(FunctionPatternPositions $functionPatternPositions): static;

    public function mask(BitMatrix $originalMatrix): BitMatrix;
}
