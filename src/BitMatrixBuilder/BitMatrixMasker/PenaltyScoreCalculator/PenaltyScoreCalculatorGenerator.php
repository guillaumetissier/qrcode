<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\PenaltyScoreCalculator;

use Generator;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\PenaltyScoreCalculatorGeneratorInterface;

final class PenaltyScoreCalculatorGenerator implements PenaltyScoreCalculatorGeneratorInterface
{
    public static function create(): self
    {
        return new self();
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return Generator<PenaltyScoreCalculatorInterface>
     */
    public function generatePenaltyScoreCalculators(): Generator
    {
        yield new AdjacentModulesInRowColInSameColorCalculator();
        yield new BlockOfModulesOfSameColorCalculator();
        yield new ProportionOfDarkModulesInEntireSymbolCalculator();
        yield new Ratio11311PatternInRowColCalculator();
    }
}
