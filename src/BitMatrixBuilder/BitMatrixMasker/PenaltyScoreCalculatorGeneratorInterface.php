<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker;

use Generator;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\PenaltyScoreCalculator\PenaltyScoreCalculatorInterface;

interface PenaltyScoreCalculatorGeneratorInterface
{
    /**
     * @return Generator<PenaltyScoreCalculatorInterface>
     */
    public function generatePenaltyScoreCalculators(): Generator;
}
