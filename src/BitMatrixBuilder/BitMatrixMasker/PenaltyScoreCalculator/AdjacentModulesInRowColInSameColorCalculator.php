<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\PenaltyScoreCalculator;

use Generator;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\Enums\WeightedPenaltyScore;

final class AdjacentModulesInRowColInSameColorCalculator implements PenaltyScoreCalculatorInterface
{
    public function calculateScore(BitMatrix $matrix): int
    {
        $size = $matrix->size();
        $score = 0;

        for ($row = 0; $row < $size; $row++) {
            $score += $this->calculatePartialScore($matrix->getRowValuesFromTopLeft($row));
        }

        for ($col = 0; $col < $size; $col++) {
            $score += $this->calculatePartialScore($matrix->getColValuesFromTopLeft($col));
        }

        return $score;
    }

    private function calculatePartialScore(Generator $colors): int
    {
        $score = 0;
        $runLength = 0;
        $currentColor = null;

        foreach ($colors as $color) {
            if ($color === $currentColor) {
                $runLength++;
            } else {
                if ($runLength >= 5) {
                    $score += WeightedPenaltyScore::N1->toInt() + ($runLength - 5);
                }
                $currentColor = $color;
                $runLength = 1;
            }
        }

        if ($runLength >= 5) {
            $score += WeightedPenaltyScore::N1->toInt() + ($runLength - 5);
        }

        return $score;
    }
}
