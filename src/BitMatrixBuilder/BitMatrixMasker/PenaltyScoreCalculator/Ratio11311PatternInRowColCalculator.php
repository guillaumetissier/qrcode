<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\PenaltyScoreCalculator;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\Enums\WeightedPenaltyScore;

final class Ratio11311PatternInRowColCalculator implements PenaltyScoreCalculatorInterface
{
    private const PATTERNS = [[1,0,1,1,1,0,1], [0,1,0,0,0,1,0]];

    public function calculateScore(BitMatrix $matrix): int
    {
        $size = $matrix->size();
        $score = 0;

        for ($row = 0; $row < $size; $row++) {
            $score += $this->checkForPatterns($matrix->rowValues($row));
        }

        for ($col = 0; $col < $size; $col++) {
            $score += $this->checkForPatterns($matrix->colValues($col));
        }

        return $score;
    }

    /**
     * @param array<int|null> $line
     * @return int
     */
    private function checkForPatterns(array $line): int
    {
        $length = count($line);
        $score = 0;

        foreach (self::PATTERNS as $pattern) {
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
