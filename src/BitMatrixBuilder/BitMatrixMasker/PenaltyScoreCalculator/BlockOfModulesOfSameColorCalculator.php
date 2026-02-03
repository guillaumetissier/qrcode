<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\PenaltyScoreCalculator;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\Enums\WeightedPenaltyScore;

final class BlockOfModulesOfSameColorCalculator implements PenaltyScoreCalculatorInterface
{
    public function calculateScore(BitMatrix $matrix): int
    {
        $size = $matrix->size();
        $score = 0;

        for ($row = 0; $row < $size - 1; $row++) {
            for ($col = 0; $col < $size - 1; $col++) {
                $c1 = $matrix->getValueFromTopLeft($col, $row);
                $c2 = $matrix->getValueFromTopLeft($col + 1, $row);
                $c3 = $matrix->getValueFromTopLeft($col, $row + 1);
                $c4 = $matrix->getValueFromTopLeft($col + 1, $row + 1);

                if ($c1 === $c2 && $c1 === $c3 && $c1 === $c4) {
                    $score += WeightedPenaltyScore::N2->toInt();
                }
            }
        }

        return $score;
    }
}
