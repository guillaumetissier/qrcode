<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\MaskerFactory;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\PenaltyScoreCalculator\PenaltyScoreCalculatorGenerator;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMaskerInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositionsInterface;
use Guillaumetissier\QrCode\Enums\Mask;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class BitMatrixMasker implements BitMatrixMaskerInterface
{
    private ?FunctionPatternPositionsInterface $functionPatternPositions = null;

    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self(
            MaskerFactory::create(),
            PenaltyScoreCalculatorGenerator::create(),
            $logger
        );
    }

    private function __construct(
        private readonly MaskerFactoryInterface $maskerFactory,
        private readonly PenaltyScoreCalculatorGeneratorInterface $penaltyScoreCalculatorFactory,
        private readonly ?IOLoggerInterface $logger = null,
    ) {
    }

    public function withFunctionPatternPositions(FunctionPatternPositionsInterface $functionPositions): self
    {
        $this->functionPatternPositions = $functionPositions;

        return $this;
    }

    /**
     * @return array{Mask, BitMatrix}
     * @throws MissingInfoException
     */
    public function mask(BitMatrix $matrix): array
    {
        if (!$this->functionPatternPositions instanceof FunctionPatternPositionsInterface) {
            throw MissingInfoException::missingInfo('functionPatternPositions', self::class);
        }

        $bestScore = null;
        $bestMatrix = null;
        $bestMask = null;

        foreach (Mask::all() as $mask) {
            $masker = $this->maskerFactory->createMasker($mask);

            $this->logger?->info("Mask the matrix with mask {$mask->value}");
            $maskedMatrix = $masker
                ->withFunctionPatternPositions($this->functionPatternPositions)
                ->mask($matrix);

            $this->logger?->info("Calculate the penalty score of mask {$mask->value}");
            $score = 0;
            foreach ($this->penaltyScoreCalculatorFactory->generatePenaltyScoreCalculators() as $scoreCalculator) {
                $score += $scoreCalculator->calculateScore($maskedMatrix);
            }

            $this->logger?->info("Penalty score for mask {$mask->value} = {$score}");

            // if the new score is better (i.e. score is lower), keep that matrix
            if ($bestScore === null || $bestScore > $score) {
                $bestScore = $score;
                $bestMatrix = $maskedMatrix;
                $bestMask = $mask;
            }
        }

        if ($bestMask === null || $bestMatrix === null) {
            throw MissingInfoException::wasNotComputed('best mask', self::class);
        }

        $this->logger?->output("Best matrix was masked with mask {$bestMask->value}");

        return [$bestMask, $bestMatrix];
    }
}
