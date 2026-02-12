<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\InfoModules\Placer\Positions;

use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\HorizontalTimingPatternPositions;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;

final class HorizontalFormatInfoPositionsTest extends TestCase
{
    private HorizontalTimingPatternPositions $moduleInfoPositions;

    public function setUp(): void
    {
        $this->moduleInfoPositions = new HorizontalTimingPatternPositions();
    }

    /**
     * @param Version $version
     * @param list<Position> $expectedPositions
     *
     * @dataProvider dataPositions
     *
     * @throws MissingInfoException
     */
    public function testPositions(Version $version, array $expectedPositions): void
    {
        $p = 0;
        foreach ($this->moduleInfoPositions->withVersion($version)->positions() as $position) {
            $this->assertEquals($expectedPositions[$p], $position);
            $p++;
        }
    }

    public static function dataPositions(): \Generator
    {
        $positions = [
            Position::fromTopLeft(0, 6), Position::fromTopLeft(1, 6), Position::fromTopLeft(2, 6),
            Position::fromTopLeft(3, 6), Position::fromTopLeft(4, 6), Position::fromTopLeft(5, 6),
            Position::fromTopLeft(6, 6), Position::fromTopLeft(7, 6), Position::fromTopLeft(8, 6),
            Position::fromTopLeft(9, 6), Position::fromTopLeft(10, 6), Position::fromTopLeft(11, 6),
            Position::fromTopLeft(12, 6), Position::fromTopLeft(13, 6), Position::fromTopLeft(14, 6),
            Position::fromTopLeft(15, 6), Position::fromTopLeft(16, 6),
        ];

        foreach (Version::all() as $version) {
            $i = count($positions);
            $positions[] = Position::fromTopLeft($i, 6);
            $positions[] = Position::fromTopLeft($i + 1, 6);
            $positions[] = Position::fromTopLeft($i + 2, 6);
            $positions[] = Position::fromTopLeft($i + 3, 6);

            yield [$version, $positions];
        }
    }
}
