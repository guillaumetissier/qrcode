<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\InfoModules\Placer\Positions;

use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\TopRightVersionInfoPositions;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;

final class TopRightVersionInfoPositionsTest extends TestCase
{
    private TopRightVersionInfoPositions $moduleInfoPositions;

    public function setUp(): void
    {
        $this->moduleInfoPositions = new TopRightVersionInfoPositions();
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
        foreach (Version::all() as $version) {
            if ($version->value < Version::V07->value) {
                continue;
            }
            $i = $version->size() - 11;
            yield "Version info for V{$version->value}" => [
                $version,
                [
                    Position::fromTopLeft($i, 0), Position::fromTopLeft($i + 1, 0), Position::fromTopLeft($i + 2, 0),
                    Position::fromTopLeft($i, 1), Position::fromTopLeft($i + 1, 1), Position::fromTopLeft($i + 2, 1),
                    Position::fromTopLeft($i, 2), Position::fromTopLeft($i + 1, 2), Position::fromTopLeft($i + 2, 2),
                    Position::fromTopLeft($i, 3), Position::fromTopLeft($i + 1, 3), Position::fromTopLeft($i + 2, 3),
                    Position::fromTopLeft($i, 4), Position::fromTopLeft($i + 1, 4), Position::fromTopLeft($i + 2, 4),
                    Position::fromTopLeft($i, 5), Position::fromTopLeft($i + 1, 5), Position::fromTopLeft($i + 2, 5),
                ],
            ];
        }
    }
}
