<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\NonDataPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\BottomExtensionPatternsPlacer;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\PatternPositionsInterface;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use PHPUnit\Framework\TestCase;

final class BottomExtensionPatternsPlacerTest extends TestCase
{
    public function testPlace(): void
    {
        $version = Version::V07;
        $size = $version->size();
        $matrix = BitMatrix::empty($size);
        $patternPlacer = new BottomExtensionPatternsPlacer($this->createPatternPositionsMock($size));
        $functionPatternPositions = NonDataPositions::empty();
        $patternPlacer->withVersion($version)->place($matrix->showValues(), $functionPatternPositions);

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
            '.................0000....0000................' . PHP_EOL .
            '.................1111....1111................' . PHP_EOL,
            "$matrix"
        );

        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(16, 43)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(16, 44)));

        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(17, 43)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(17, 44)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(20, 43)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(20, 44)));

        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(21, 43)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(21, 44)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(24, 43)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(24, 44)));

        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(25, 43)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(25, 44)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(28, 43)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(28, 44)));

        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(29, 43)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(29, 44)));
    }

    private function createPatternPositionsMock(int $size): PatternPositionsInterface
    {
        $mock = $this->createMock(PatternPositionsInterface::class);
        $mock->method('withVersion')->willReturnSelf();
        $mock->method('positions')->willReturn(
            (function () use ($size) {
                yield Position::fromBottomRight(16, 0, $size);
                yield Position::fromBottomRight(17, 0, $size);
                yield Position::fromBottomRight(18, 0, $size);
                yield Position::fromBottomRight(19, 0, $size);

                yield Position::fromBottomRight(16, 1, $size);
                yield Position::fromBottomRight(17, 1, $size);
                yield Position::fromBottomRight(18, 1, $size);
                yield Position::fromBottomRight(19, 1, $size);

                yield Position::fromBottomRight(24, 0, $size);
                yield Position::fromBottomRight(25, 0, $size);
                yield Position::fromBottomRight(26, 0, $size);
                yield Position::fromBottomRight(27, 0, $size);

                yield Position::fromBottomRight(24, 1, $size);
                yield Position::fromBottomRight(25, 1, $size);
                yield Position::fromBottomRight(26, 1, $size);
                yield Position::fromBottomRight(27, 1, $size);
            })()
        );

        return $mock;
    }
}
