<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositionsInterface;

interface MaskerInterface
{
    public function withFunctionPatternPositions(FunctionPatternPositionsInterface $functionPatternPositions): static;

    public function mask(BitMatrix $originalMatrix): BitMatrix;
}
