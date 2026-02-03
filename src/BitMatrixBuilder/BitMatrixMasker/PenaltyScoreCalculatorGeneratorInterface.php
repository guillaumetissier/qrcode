<?php

declare(strict_types=1);

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
