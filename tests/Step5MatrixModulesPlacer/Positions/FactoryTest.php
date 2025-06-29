<?php

namespace Tests\Step5MatrixModulesPlacer\Positions;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Enums\FunctionPatternType;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions as P;

class FactoryTest extends TestCase
{
    private P\Factory $factory;

    public function setUp(): void
    {
        $this->factory = new P\Factory();
    }

    /**
     * @dataProvider provideDataToTestCreate
     */
    public function testCreate(FunctionPatternType $patternType, ?string $expectedPlacer): void
    {
        if ($expectedPlacer === null) {
            $this->assertNull($this->factory->create($patternType));
        } else {
            $this->assertInstanceOf($expectedPlacer, $this->factory->create($patternType));
        }
    }

    public static function provideDataToTestCreate(): \Generator
    {
        yield [FunctionPatternType::ALIGNMENT_PATTERNS, P\AlignmentPatternsCenterPositions::class];
        yield [FunctionPatternType::DATA_CODEWORDS, P\DataCodewordPositions::class];
        yield [FunctionPatternType::BOTTOM_EXTENSION_PATTERNS, P\BottomExtensionPatternsPositions::class];
        yield [FunctionPatternType::BOTTOM_RIGHT_EXTENSION_PATTERNS, P\BottomRightExtensionPatternsPositions::class];
        yield [FunctionPatternType::RIGHT_EXTENSION_PATTERNS, P\RightExtensionPatternsPositions::class];
        yield [FunctionPatternType::POSITION_DETECTION_PATTERNS, P\FinderPatternsCenterPositions::class];
        yield [FunctionPatternType::HORIZONTAL_TIMING_PATTERNS, P\HorizontalTimingPatternsPositions::class];
        yield [FunctionPatternType::VERTICAL_TIMING_PATTERNS, P\VerticalTimingPatternsPositions::class];
    }
}
