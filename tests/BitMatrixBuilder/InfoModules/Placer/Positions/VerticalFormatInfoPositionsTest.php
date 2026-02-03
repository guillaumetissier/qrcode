<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\InfoModules\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\HorizontalTimingPatternPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\VerticalFormatInfoPositions;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;

class VerticalFormatInfoPositionsTest extends TestCase
{
    private VerticalFormatInfoPositions $moduleInfoPositions;

    public function setUp(): void
    {
        $this->moduleInfoPositions = new VerticalFormatInfoPositions();
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

    public static function dataPositions(): Generator
    {
        $positions = [
            Position::fromTopLeft(8, 0), Position::fromTopLeft(8, 1), Position::fromTopLeft(8, 2),
            Position::fromTopLeft(8, 3), Position::fromTopLeft(8, 4), Position::fromTopLeft(8, 5),
            Position::fromTopLeft(8, 7), Position::fromTopLeft(8, 8),
        ];

        foreach (Version::all() as $version) {
            $i = $version->size() - 8;
            yield [
                $version,
                array_merge($positions, [
                    Position::fromTopLeft(8, $i), Position::fromTopLeft(8, $i + 1),
                    Position::fromTopLeft(8, $i + 2), Position::fromTopLeft(8, $i + 3),
                    Position::fromTopLeft(8, $i + 4), Position::fromTopLeft(8, $i + 5),
                    Position::fromTopLeft(8, $i + 6), Position::fromTopLeft(8, $i + 7),
                ]),
            ];
        }
    }
}
