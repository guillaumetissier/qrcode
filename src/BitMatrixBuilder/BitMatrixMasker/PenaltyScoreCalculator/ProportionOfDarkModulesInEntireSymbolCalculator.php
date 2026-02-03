<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\PenaltyScoreCalculator;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\Enums\WeightedPenaltyScore;

final class ProportionOfDarkModulesInEntireSymbolCalculator implements PenaltyScoreCalculatorInterface
{
    public function calculateScore(BitMatrix $matrix): int
    {
        $size = $matrix->size();
        $totalModules = $size * $size;
        $darkCount = 0;

        for ($row = 0; $row < $size; $row++) {
            for ($col = 0; $col < $size; $col++) {
                if ($matrix->getValueFromTopLeft($row, $col) === 1) {
                    $darkCount++;
                }
            }
        }

        $darkPercentage = ($darkCount * 100) / $totalModules;
        $deviation = abs($darkPercentage - 50);

        return (int)(floor($deviation / 5) * WeightedPenaltyScore::N4->toInt());
    }
}
