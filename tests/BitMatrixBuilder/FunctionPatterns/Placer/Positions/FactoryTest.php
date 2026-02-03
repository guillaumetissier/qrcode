<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Positions as P;
use Guillaumetissier\QrCode\Enums\FunctionPatternType;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    private \Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\PatternPositionsFactory $factory;

    public function setUp(): void
    {
        $this->factory = \Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\PatternPositionsFactory::create();
    }

    /**
     * @dataProvider dataCreatePatternPositions
     */
    public function testCreatePatternPositions(FunctionPatternType $patternType, ?string $expectedPlacer): void
    {
        if ($expectedPlacer === null) {
            $this->assertNull($this->factory->createPatternPositions($patternType));
        } else {
            $this->assertInstanceOf($expectedPlacer, $this->factory->createPatternPositions($patternType));
        }
    }

    public static function dataCreatePatternPositions(): \Generator
    {
        yield [FunctionPatternType::ALIGNMENT_PATTERNS, \Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\AlignmentPatternCenterPositions::class];
        yield [FunctionPatternType::BOTTOM_EXTENSION_PATTERNS, \Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\BottomExtensionPatternPositions::class];
        yield [FunctionPatternType::BOTTOM_RIGHT_EXTENSION_PATTERNS, \Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\BottomRightExtensionPatternPositions::class];
        yield [FunctionPatternType::RIGHT_EXTENSION_PATTERNS, \Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\RightExtensionPatternPositions::class];
        yield [FunctionPatternType::POSITION_DETECTION_PATTERNS, \Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\FinderPatternCenterPositions::class];
        yield [FunctionPatternType::HORIZONTAL_TIMING_PATTERNS, \Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\HorizontalTimingPatternPositions::class];
        yield [FunctionPatternType::VERTICAL_TIMING_PATTERNS, \Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\VerticalTimingPatternPositions::class];
    }
}
