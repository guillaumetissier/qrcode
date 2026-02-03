<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;

interface DataCodewordPlacerInterface
{
    public function withData(BitStringInterface $data): self;

    public function place(BitMatrix $matrix, FunctionPatternPositions $functionPatternPositions): void;
}
