<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\NonDataPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\PatternPositionsInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\RightExtensionPatternsPlacer;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use PHPUnit\Framework\TestCase;

class RightExtensionPatternsPlacerTest extends TestCase
{
    public function testPlace(): void
    {
        $version = Version::V07;
        $matrix = BitMatrix::empty($version->size());
        $functionPatternPositions = NonDataPositions::empty();
        $finderPatterns = new RightExtensionPatternsPlacer($this->createPatternPositionsMock($version->size()));
        $finderPatterns->withVersion($version)->place($matrix->showValues(), $functionPatternPositions);

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
            '...........................................01' . PHP_EOL .
            '...........................................01' . PHP_EOL .
            '...........................................01' . PHP_EOL .
            '...........................................01' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '.............................................' . PHP_EOL .
            '...........................................01' . PHP_EOL .
            '...........................................01' . PHP_EOL .
            '...........................................01' . PHP_EOL .
            '...........................................01' . PHP_EOL .
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
            '.............................................' . PHP_EOL,
            "$matrix"
        );
    }

    private function createPatternPositionsMock(int $size): PatternPositionsInterface
    {
        $mock = $this->createMock(PatternPositionsInterface::class);
        $mock->method('withVersion')->willReturnSelf();
        $mock->method('positions')->willReturn(
            (function () use ($size) {
                yield Position::fromBottomRight(0, 16, $size);
                yield Position::fromBottomRight(0, 17, $size);
                yield Position::fromBottomRight(0, 18, $size);
                yield Position::fromBottomRight(0, 19, $size);
                yield Position::fromBottomRight(1, 16, $size);
                yield Position::fromBottomRight(1, 17, $size);
                yield Position::fromBottomRight(1, 18, $size);
                yield Position::fromBottomRight(1, 19, $size);

                yield Position::fromBottomRight(0, 24, $size);
                yield Position::fromBottomRight(0, 25, $size);
                yield Position::fromBottomRight(0, 26, $size);
                yield Position::fromBottomRight(0, 27, $size);
                yield Position::fromBottomRight(1, 24, $size);
                yield Position::fromBottomRight(1, 25, $size);
                yield Position::fromBottomRight(1, 26, $size);
                yield Position::fromBottomRight(1, 27, $size);
            })()
        );

        return $mock;
    }
}
