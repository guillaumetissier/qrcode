<?php

namespace Tests\Step5MatrixModulesPlacer\Positions;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Enums\FunctionPatternType;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions as Positions;

class FactoryTest extends TestCase
{
    private Positions\Factory $factory;

    public function setUp(): void
    {
        $this->factory = new Positions\Factory();
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
        yield [FunctionPatternType::ALIGNMENT_PATTERNS, Positions\AlignmentPatternsCenterPositions::class];
        yield [FunctionPatternType::DATA_CODEWORDS, Positions\DataCodewordPositions::class];
        yield [FunctionPatternType::EXTENSION_PATTERNS, Positions\ExtensionPatternsPositions::class];
        yield [FunctionPatternType::POSITION_DETECTION_PATTERNS, Positions\FinderPatternsCenterPositions::class];
        yield [FunctionPatternType::HORIZONTAL_TIMING_PATTERNS, Positions\HorizontalTimingPatternsPositions::class];
        yield [FunctionPatternType::VERTICAL_TIMING_PATTERNS, Positions\VerticalTimingPatternsPositions::class];
    }
}
