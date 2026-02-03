<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\BitMatrixMasker;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\BitMatrixMasker;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\MaskerInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\MaskerFactoryInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\PenaltyScoreCalculator\PenaltyScoreCalculatorInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\PenaltyScoreCalculatorGeneratorInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositionsInterface;
use Guillaumetissier\QrCode\Enums\Mask;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;
use PHPUnit\Framework\TestCase;

class BitMatrixMaskerTest extends TestCase
{
    private MaskerFactoryInterface $maskerFactory;
    private PenaltyScoreCalculatorGeneratorInterface $penaltyScoreCalculatorFactory;
    private IOLoggerInterface $logger;
    private BitMatrix $matrix;
    private FunctionPatternPositionsInterface $functionPatternPositions;

    protected function setUp(): void
    {
        $this->maskerFactory = $this->createMock(MaskerFactoryInterface::class);
        $this->penaltyScoreCalculatorFactory = $this->createMock(PenaltyScoreCalculatorGeneratorInterface::class);
        $this->logger = $this->createMock(IOLoggerInterface::class);
        $this->matrix = $this->createMock(BitMatrix::class);
        $this->functionPatternPositions = $this->createMock(FunctionPatternPositionsInterface::class);
    }

    public function testCreateReturnsInstance(): void
    {
        $this->assertInstanceOf(BitMatrixMasker::class, BitMatrixMasker::create());
    }

    public function testCreateWithLogger(): void
    {
        $logger = $this->createMock(IOLoggerInterface::class);

        $this->assertInstanceOf(BitMatrixMasker::class, BitMatrixMasker::create($logger));
    }

    public function testWithFunctionPatternPositionsReturnsFluentInterface(): void
    {
        $masker = $this->createMasker();

        $this->assertSame($masker, $masker->withFunctionPatternPositions($this->functionPatternPositions));
    }

    public function testMaskThrowsExceptionWhenFunctionPatternPositionsNotSet(): void
    {
        $masker = $this->createMasker();

        $this->expectException(MissingInfoException::class);
        $this->expectExceptionMessage('functionPatternPositions');

        $masker->mask($this->matrix);
    }

    public function testMaskSelectsBestMaskBasedOnLowestScore(): void
    {
        // Setup: mask 0 has score 100, mask 1 has score 50, mask 2 has score 75
        $maskedMatrices = [];
        $maskers = [];
        foreach (Mask::all() as $mask) {
            $maskedMatrices[$mask->value] = $this->createMock(BitMatrix::class);
            $maskers[$mask->value] = $this->createMockMasker($maskedMatrices[$mask->value]);
        }

        $this->maskerFactory
            ->expects($this->exactly(8))
            ->method('createMasker')
            ->willReturnCallback(function (Mask $mask) use ($maskers) {
                return $maskers[$mask->value];
            });

        $scoreCalculator = $this->createMock(PenaltyScoreCalculatorInterface::class);
        $scoreCalculator
            ->method('calculateScore')
            ->willReturnCallback(function (BitMatrix $matrix) use ($maskedMatrices) {
                $scores = [Mask::MASK0->value => 100, Mask::MASK1->value => 50, Mask::MASK2->value => 75];
                foreach ($maskedMatrices as $masked => $maskedMatrix) {
                    if ($maskedMatrix === $matrix) {
                        return $scores[$masked] ?? 999;
                    }
                }
                return 999;
            });

        $this->penaltyScoreCalculatorFactory
            ->method('generatePenaltyScoreCalculators')
            ->willReturnCallback(function () use ($scoreCalculator) {
                yield $scoreCalculator;
            });

        $masker = $this->createMasker();
        $masker->withFunctionPatternPositions($this->functionPatternPositions);

        [$bestMask, $bestMatrix] = $masker->mask($this->matrix);

        $this->assertSame(Mask::MASK1, $bestMask);
        $this->assertSame($maskedMatrices[Mask::MASK1->value], $bestMatrix);
    }

    public function testMaskCalculatesScoreFromMultipleCalculators(): void
    {
        // Setup: 3 calculators that return 10, 20, 30 for a total of 60
        $maskedMatrix = $this->createMock(BitMatrix::class);
        $masker = $this->createMockMasker($maskedMatrix);

        $this->maskerFactory
            ->method('createMasker')
            ->willReturn($masker);

        $calculator1 = $this->createMock(PenaltyScoreCalculatorInterface::class);
        $calculator1->method('calculateScore')->willReturn(10);

        $calculator2 = $this->createMock(PenaltyScoreCalculatorInterface::class);
        $calculator2->method('calculateScore')->willReturn(20);

        $calculator3 = $this->createMock(PenaltyScoreCalculatorInterface::class);
        $calculator3->method('calculateScore')->willReturn(30);

        $this->penaltyScoreCalculatorFactory
            ->method('generatePenaltyScoreCalculators')
            ->willReturnCallback(function () use ($calculator1, $calculator2, $calculator3) {
                yield $calculator1;
                yield $calculator2;
                yield $calculator3;
            });

        $masker = $this->createMasker();
        $masker->withFunctionPatternPositions($this->functionPatternPositions);

        [$bestMask, $bestMatrix] = $masker->mask($this->matrix);

        // Should still work and return the only available mask
        $this->assertInstanceOf(Mask::class, $bestMask);
        $this->assertSame($maskedMatrix, $bestMatrix);
    }

    public function testMaskLogsInformationWhenLoggerProvided(): void
    {
        $maskedMatrix = $this->createMock(BitMatrix::class);
        $masker = $this->createMockMasker($maskedMatrix);

        $this->maskerFactory
            ->method('createMasker')
            ->willReturn($masker);

        $calculator = $this->createMock(PenaltyScoreCalculatorInterface::class);
        $calculator->method('calculateScore')->willReturn(50);

        $this->penaltyScoreCalculatorFactory
            ->method('generatePenaltyScoreCalculators')
            ->willReturnCallback(function () use ($calculator) {
                yield $calculator;
            });

        // Expect logging calls
        $this->logger
            ->expects($this->atLeastOnce())
            ->method('info');

        $this->logger
            ->expects($this->once())
            ->method('output')
            ->with($this->stringContains('Best matrix was masked with mask'));

        $masker = $this->createMasker($this->logger);
        $masker->withFunctionPatternPositions($this->functionPatternPositions);

        $masker->mask($this->matrix);
    }

    public function testMaskWorksWithoutLogger(): void
    {
        $maskedMatrix = $this->createMock(BitMatrix::class);
        $masker = $this->createMockMasker($maskedMatrix);

        $this->maskerFactory
            ->method('createMasker')
            ->willReturn($masker);

        $calculator = $this->createMock(PenaltyScoreCalculatorInterface::class);
        $calculator->method('calculateScore')->willReturn(50);

        $this->penaltyScoreCalculatorFactory
            ->method('generatePenaltyScoreCalculators')
            ->willReturnCallback(function () use ($calculator) {
                yield $calculator;
            });

        $masker = $this->createMasker(); // No logger
        $masker->withFunctionPatternPositions($this->functionPatternPositions);

        [$bestMask, $bestMatrix] = $masker->mask($this->matrix);

        $this->assertInstanceOf(Mask::class, $bestMask);
        $this->assertSame($maskedMatrix, $bestMatrix);
    }

    public function testMaskSelectsFirstMaskWhenAllScoresAreEqual(): void
    {
        $maskedMatrix0 = $this->createMock(BitMatrix::class);
        $maskedMatrix1 = $this->createMock(BitMatrix::class);

        $masker0 = $this->createMockMasker($maskedMatrix0);
        $masker1 = $this->createMockMasker($maskedMatrix1);

        $this->maskerFactory
            ->method('createMasker')
            ->willReturnCallback(function (Mask $mask) use ($masker0, $masker1) {
                return match ($mask) {
                    Mask::MASK0 => $masker0,
                    Mask::MASK1 => $masker1,
                    default => $masker0,
                };
            });

        $calculator = $this->createMock(PenaltyScoreCalculatorInterface::class);
        $calculator->method('calculateScore')->willReturn(100); // Same score for all

        $this->penaltyScoreCalculatorFactory
            ->method('generatePenaltyScoreCalculators')
            ->willReturnCallback(function () use ($calculator) {
                yield $calculator;
            });

        $masker = $this->createMasker();
        $masker->withFunctionPatternPositions($this->functionPatternPositions);

        [$bestMask, $bestMatrix] = $masker->mask($this->matrix);

        // Should select the first mask (MASK_000)
        $this->assertSame(Mask::MASK0, $bestMask);
        $this->assertSame($maskedMatrix0, $bestMatrix);
    }

    public function testMaskIteratesOverAllMasks(): void
    {
        $callCount = 0;

        $maskedMatrix = $this->createMock(BitMatrix::class);
        $maskerMock = $this->createMockMasker($maskedMatrix);

        $this->maskerFactory
            ->method('createMasker')
            ->willReturnCallback(function () use ($maskerMock, &$callCount) {
                $callCount++;
                return $maskerMock;
            });

        $calculator = $this->createMock(PenaltyScoreCalculatorInterface::class);
        $calculator->method('calculateScore')->willReturn(50);

        $this->penaltyScoreCalculatorFactory
            ->method('generatePenaltyScoreCalculators')
            ->willReturnCallback(function () use ($calculator) {
                yield $calculator;
            });

        $masker = $this->createMasker();
        $masker->withFunctionPatternPositions($this->functionPatternPositions);

        $masker->mask($this->matrix);

        // Should have called createMasker for each mask (8 masks in total)
        $this->assertEquals(count(Mask::all()), $callCount);
    }

    private function createMasker(): BitMatrixMasker
    {
        $reflection = new \ReflectionClass(BitMatrixMasker::class);
        $testInstance = $reflection->newInstanceWithoutConstructor();
        $maskerFactoryProperty = $reflection->getProperty('maskerFactory');
        $maskerFactoryProperty->setValue($testInstance, $this->maskerFactory);
        $penaltyScoreCalculatorFactoryProperty = $reflection->getProperty('penaltyScoreCalculatorFactory');
        $penaltyScoreCalculatorFactoryProperty->setValue($testInstance, $this->penaltyScoreCalculatorFactory);
        $loggerProperty = $reflection->getProperty('logger');
        $loggerProperty->setValue($testInstance, $this->logger);

        return $testInstance;
    }

    private function createMockMasker(BitMatrix $returnMatrix): MaskerInterface
    {
        $masker = $this->createMock(MaskerInterface::class);
        $masker
            ->method('withFunctionPatternPositions')
            ->willReturnSelf();
        $masker
            ->method('mask')
            ->willReturn($returnMatrix);

        return $masker;
    }
}
