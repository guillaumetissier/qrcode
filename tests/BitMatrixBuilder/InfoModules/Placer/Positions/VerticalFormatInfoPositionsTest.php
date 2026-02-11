<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\InfoModules\Placer\Positions;

use Generator;
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
        $col = 8;
        $positions = [
            Position::fromTopLeft($col, 0), Position::fromTopLeft($col, 1), Position::fromTopLeft($col, 2),
            Position::fromTopLeft($col, 3), Position::fromTopLeft($col, 4), Position::fromTopLeft($col, 5),
            Position::fromTopLeft($col, 7), Position::fromTopLeft($col, 8),
        ];

        foreach (Version::all() as $version) {
            $size = $version->size();
            yield [
                $version,
                array_merge($positions, [
                    Position::fromBottomLeft($col, 6, $size), Position::fromBottomLeft($col, 5, $size),
                    Position::fromBottomLeft($col, 4, $size), Position::fromBottomLeft($col, 3, $size),
                    Position::fromBottomLeft($col, 2, $size), Position::fromBottomLeft($col, 1, $size),
                    Position::fromBottomLeft($col, 0, $size),
                ]),
            ];
        }
    }
}
