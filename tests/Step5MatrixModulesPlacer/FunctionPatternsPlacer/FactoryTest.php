<?php

namespace Tests\Step5MatrixModulesPlacer\FunctionPatternsPlacer;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Enums\FunctionPatternType;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer as P;

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
    public function testCreate(FunctionPatternType $patternType, string $expectedPlacer): void
    {
        $this->assertInstanceOf($expectedPlacer, $this->factory->create($patternType));
    }

    public static function provideDataToTestCreate(): \Generator
    {
        yield [FunctionPatternType::ALIGNMENT_PATTERNS, P\AlignmentPatternsPlacer::class];
        yield [FunctionPatternType::DATA_CODEWORDS, P\DataCodewordsPlacer::class];
        yield [FunctionPatternType::BOTTOM_EXTENSION_PATTERNS, P\BottomExtensionPatternsPlacer::class];
        yield [FunctionPatternType::BOTTOM_RIGHT_EXTENSION_PATTERNS, P\BottomRightExtensionPatternsPlacer::class];
        yield [FunctionPatternType::RIGHT_EXTENSION_PATTERNS, P\RightExtensionPatternsPlacer::class];
        yield [FunctionPatternType::POSITION_DETECTION_PATTERNS, P\PositionDetectionPatternsPlacer::class];
        yield [FunctionPatternType::HORIZONTAL_TIMING_PATTERNS, P\TimingPatternsPlacer::class];
        yield [FunctionPatternType::VERTICAL_TIMING_PATTERNS, P\TimingPatternsPlacer::class];
    }
}
