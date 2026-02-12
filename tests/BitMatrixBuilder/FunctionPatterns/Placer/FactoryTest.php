<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\Enums\FunctionPatternType;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer as P;
use PHPUnit\Framework\TestCase;

final class FactoryTest extends TestCase
{
    private P\PatternPlacerFactory $factory;

    public function setUp(): void
    {
        $this->factory = P\PatternPlacerFactory::create();
    }

    /**
     * @param FunctionPatternType $patternType
     * @param class-string $expectedPlacer
     * @return void
     * @dataProvider dataCreatePatternPlacer
     */
    public function testCreatePatternPlacer(FunctionPatternType $patternType, string $expectedPlacer): void
    {
        $this->assertInstanceOf($expectedPlacer, $this->factory->createPatternPlacer($patternType));
    }

    public static function dataCreatePatternPlacer(): \Generator
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
