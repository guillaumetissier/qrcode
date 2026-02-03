<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\PenaltyScoreCalculator;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;

interface PenaltyScoreCalculatorInterface
{
    public function calculateScore(BitMatrix $matrix): int;
}
