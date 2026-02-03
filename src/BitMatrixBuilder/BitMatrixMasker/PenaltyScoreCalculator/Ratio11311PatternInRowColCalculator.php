<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\PenaltyScoreCalculator;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\Enums\WeightedPenaltyScore;

final class Ratio11311PatternInRowColCalculator implements PenaltyScoreCalculatorInterface
{
    public function calculateScore(BitMatrix $matrix): int
    {
        $size = $matrix->size();
        $score = 0;
        $patterns = [[1,0,1,1,1,0,1], [0,1,0,0,0,1,0]];

        for ($row = 0; $row < $size; $row++) {
            $rows = [];
            for ($col = 0; $col < $size; $col++) {
                $rows[] = (int)$matrix->getValueFromTopLeft($row, $col);
            }
            $score += $this->checkLineForPatterns($rows, $patterns);
        }

        for ($col = 0; $col < $size; $col++) {
            $cols = [];
            for ($row = 0; $row < $size; $row++) {
                $cols[] = (int)$matrix->getValueFromTopLeft($row, $col);
            }
            $score += $this->checkLineForPatterns($cols, $patterns);
        }

        return $score;
    }

    /**
     * @param int[] $line
     * @param int[][] $patterns
     * @return int
     */
    private function checkLineForPatterns(array $line, array $patterns): int
    {
        $length = count($line);
        $score = 0;

        foreach ($patterns as $pattern) {
            $pLen = count($pattern);

            for ($i = 0; $i <= $length - $pLen; $i++) {
                $slice = array_slice($line, $i, $pLen);

                if ($slice === $pattern) {
                    $score += WeightedPenaltyScore::N3->toInt();
                }
            }
        }

        return $score;
    }
}
