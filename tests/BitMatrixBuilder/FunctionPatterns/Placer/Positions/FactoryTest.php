<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions as P;
use Guillaumetissier\QrCode\Enums\FunctionPatternType;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    private P\PatternPositionsFactory $factory;

    public function setUp(): void
    {
        $this->factory = P\PatternPositionsFactory::create();
    }

    /**
     * @param FunctionPatternType $patternType
     * @param class-string $expectedPlacer
     * @return void
     * @dataProvider dataCreatePatternPositions
     */
    public function testCreatePatternPositions(FunctionPatternType $patternType, string $expectedPlacer): void
    {
        $this->assertInstanceOf($expectedPlacer, $this->factory->createPatternPositions($patternType));
    }

    public static function dataCreatePatternPositions(): \Generator
    {
        yield [FunctionPatternType::ALIGNMENT_PATTERNS, P\AlignmentPatternCenterPositions::class];
        yield [FunctionPatternType::BOTTOM_EXTENSION_PATTERNS, P\BottomExtensionPatternPositions::class];
        yield [FunctionPatternType::BOTTOM_RIGHT_EXTENSION_PATTERNS, P\BottomRightExtensionPatternPositions::class];
        yield [FunctionPatternType::RIGHT_EXTENSION_PATTERNS, P\RightExtensionPatternPositions::class];
        yield [FunctionPatternType::POSITION_DETECTION_PATTERNS, P\FinderPatternCenterPositions::class];
        yield [FunctionPatternType::HORIZONTAL_TIMING_PATTERNS, P\HorizontalTimingPatternPositions::class];
        yield [FunctionPatternType::VERTICAL_TIMING_PATTERNS, P\VerticalTimingPatternPositions::class];
    }
}
