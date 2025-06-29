<?php

namespace Tests\Step5MatrixModulesPlacer\FunctionPatternsPlacer;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Enums\FunctionPatternType;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer\AlignmentPatternsPlacer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer\DataCodewordsPlacer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer\ExtensionPatternsPlacer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer\Factory;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer\PositionDetectionPatternsPlacer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer\TimingPatternsPlacer;

class FactoryTest extends TestCase
{
    private Factory $factory;

    public function setUp(): void
    {
        $this->factory = new Factory();
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
        yield [FunctionPatternType::ALIGNMENT_PATTERNS, AlignmentPatternsPlacer::class];
        yield [FunctionPatternType::DATA_CODEWORDS, DataCodewordsPlacer::class];
        yield [FunctionPatternType::EXTENSION_PATTERNS, ExtensionPatternsPlacer::class];
        yield [FunctionPatternType::POSITION_DETECTION_PATTERNS, PositionDetectionPatternsPlacer::class];
        yield [FunctionPatternType::HORIZONTAL_TIMING_PATTERNS, TimingPatternsPlacer::class];
        yield [FunctionPatternType::VERTICAL_TIMING_PATTERNS, TimingPatternsPlacer::class];
    }
}
