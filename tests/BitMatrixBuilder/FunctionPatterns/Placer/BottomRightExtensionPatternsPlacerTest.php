<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\NonDataPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\BottomRightExtensionPatternsPlacer;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\PatternPositionsInterface;
use Guillaumetissier\QrCode\Common\Position;
use PHPUnit\Framework\TestCase;

class BottomRightExtensionPatternsPlacerTest extends TestCase
{
    public function testPlace(): void
    {
        $size = 45;
        $matrix = BitMatrix::empty($size);
        $functionPatternPositions = NonDataPositions::empty();
        $patternsPlacer = new BottomRightExtensionPatternsPlacer($this->createPatternPositionsMock($size));
        $patternsPlacer->place($matrix->showValues(), $functionPatternPositions);

        $this->assertEquals(
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '...........................................00' . PHP_EOL .
            '...........................................01' . PHP_EOL,
            "$matrix"
        );

        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(44, 44)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(44, 43)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(43, 44)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(43, 43)));

        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(42, 44)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(42, 43)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(44, 42)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(43, 42)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(42, 42)));
    }

    private function createPatternPositionsMock(int $size): PatternPositionsInterface
    {
        $mock = $this->createMock(PatternPositionsInterface::class);
        $mock->method('withVersion')->willReturnSelf();
        $mock->method('positions')->willReturn(
            (function () use ($size) {
                yield Position::fromBottomRight(0, 0, $size);
                yield Position::fromBottomRight(1, 0, $size);
                yield Position::fromBottomRight(0, 1, $size);
                yield Position::fromBottomRight(1, 1, $size);
            })()
        );

        return $mock;
    }
}
