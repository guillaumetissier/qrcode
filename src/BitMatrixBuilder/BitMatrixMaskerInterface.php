<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositionsInterface;
use Guillaumetissier\QrCode\Enums\Mask;

interface BitMatrixMaskerInterface
{
    public function withFunctionPatternPositions(FunctionPatternPositionsInterface $functionPositions): self;

    /**
     * @return array{Mask, BitMatrix}
     */
    public function mask(BitMatrix $matrix): array;
}
