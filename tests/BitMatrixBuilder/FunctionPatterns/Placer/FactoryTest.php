<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\Enums\FunctionPatternType;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer as P;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    private P\PatternPlacerFactory $factory;

    public function setUp(): void
    {
        $this->factory = P\PatternPlacerFactory::create();
    }

    private function createPatternPlacerFactory(): P\PatternPlacerFactory
    {
    }

    /**
     * @dataProvider provideDataToTestCreate
     */
    public function testCreate(FunctionPatternType $patternType, string $expectedPlacer): void
    {
        $this->assertInstanceOf($expectedPlacer, $this->factory->createPatternPlacer($patternType));
    }

    public static function provideDataToTestCreate(): \Generator
    {
        yield [FunctionPatternType::ALIGNMENT_PATTERNS, P\AlignmentPatternsPlacer::class];
        yield [FunctionPatternType::BOTTOM_EXTENSION_PATTERNS, P\BottomExtensionPatternsPlacer::class];
        yield [FunctionPatternType::BOTTOM_RIGHT_EXTENSION_PATTERNS, P\BottomRightExtensionPatternsPlacer::class];
        yield [FunctionPatternType::RIGHT_EXTENSION_PATTERNS, P\RightExtensionPatternsPlacer::class];
        yield [FunctionPatternType::POSITION_DETECTION_PATTERNS, P\PositionDetectionPatternsPlacer::class];
        yield [FunctionPatternType::HORIZONTAL_TIMING_PATTERNS, P\TimingPatternsPlacer::class];
        yield [FunctionPatternType::VERTICAL_TIMING_PATTERNS, P\TimingPatternsPlacer::class];
    }
}
