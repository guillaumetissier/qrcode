<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\NonDataPositionsInterface;

interface DataCodewordPlacerInterface
{
    public function withData(BitStringInterface $data): self;

    public function place(BitMatrix $matrix, NonDataPositionsInterface $functionPatternPositions): void;
}
