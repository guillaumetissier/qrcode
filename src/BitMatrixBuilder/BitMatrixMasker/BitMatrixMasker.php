<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\MaskerFactory;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\PenaltyScoreCalculator\PenaltyScoreCalculatorGenerator;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMaskerInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;
use Guillaumetissier\QrCode\Enums\Mask;
use Guillaumetissier\QrCode\Exception\MissingParameter;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class BitMatrixMasker implements BitMatrixMaskerInterface
{
    private ?FunctionPatternPositions $functionPatternPositions = null;

    public static function create(?IOLoggerInterface $IOLogger = null): self
    {
        return new self(MaskerFactory::create(), PenaltyScoreCalculatorGenerator::create(), $IOLogger);
    }

    private function __construct(
        private readonly MaskerFactoryInterface $maskerFactory,
        private readonly PenaltyScoreCalculatorGeneratorInterface $penaltyScoreCalculatorFactory,
        private readonly ?IOLoggerInterface $IOLogger = null,
    ) {
    }

    public function withFunctionPatternPositions(FunctionPatternPositions $functionPositions): self
    {
        $this->functionPatternPositions = $functionPositions;

        return $this;
    }

    /**
     * @return array{Mask, BitMatrix}
     * @throws MissingParameter
     */
    public function mask(BitMatrix $matrix): array
    {
        if (!$this->functionPatternPositions instanceof FunctionPatternPositions) {
            throw MissingParameter::missingParameter('functionPatternPositions', self::class);
        }

        $bestScore = null;
        $bestMatrix = null;
        $bestMask = null;

        foreach (Mask::all() as $mask) {
            $masker = $this->maskerFactory->createMasker($mask);

            $this->IOLogger?->info("Mask the matrix with mask {$mask->value}");
            $maskedMatrix = $masker
                ->withFunctionPatternPositions($this->functionPatternPositions)
                ->mask($matrix);

            $this->IOLogger?->info("Calculate the penalty score of mask {$mask->value}");
            $score = 0;
            foreach ($this->penaltyScoreCalculatorFactory->generatePenaltyScoreCalculators() as $scoreCalculator) {
                $score += $scoreCalculator->calculateScore($maskedMatrix);
            }

            $this->IOLogger?->info("Penalty score for mask {$mask->value} = {$score}");

            // if the new score is better (i.e. score is lower), keep that matrix
            if ($bestScore === null || $bestScore > $score) {
                $bestScore = $score;
                $bestMatrix = $maskedMatrix;
                $bestMask = $mask;
            }
        }

        $this->IOLogger?->output("Best matrix was masked with mask {$bestMask->value}");

        return [$bestMask, $bestMatrix];
    }
}
