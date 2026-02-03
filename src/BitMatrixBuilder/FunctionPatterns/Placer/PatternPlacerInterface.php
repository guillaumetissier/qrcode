<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositionsInterface;
use Guillaumetissier\QrCode\Enums\Version;

interface PatternPlacerInterface
{
    public function withVersion(Version $version): self;

    public function place(BitMatrix $matrix, FunctionPatternPositionsInterface $functionPatternPositions): void;
}
