<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\InfoModules\Placer\Positions;

use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\BottomLeftVersionInfoPositions;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;

final class BottomLeftVersionInfoPositionsTest extends TestCase
{
    private BottomLeftVersionInfoPositions $moduleInfoPositions;

    public function setUp(): void
    {
        $this->moduleInfoPositions = new BottomLeftVersionInfoPositions();
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
                    Position::fromTopLeft(0, $i + 0), Position::fromTopLeft(0, $i + 1),
                    Position::fromTopLeft(0, $i + 2), Position::fromTopLeft(1, $i + 0),
                    Position::fromTopLeft(1, $i + 1), Position::fromTopLeft(1, $i + 2),
                    Position::fromTopLeft(2, $i + 0), Position::fromTopLeft(2, $i + 1),
                    Position::fromTopLeft(2, $i + 2), Position::fromTopLeft(3, $i + 0),
                    Position::fromTopLeft(3, $i + 1), Position::fromTopLeft(3, $i + 2),
                    Position::fromTopLeft(4, $i + 0), Position::fromTopLeft(4, $i + 1),
                    Position::fromTopLeft(4, $i + 2), Position::fromTopLeft(5, $i + 0),
                    Position::fromTopLeft(5, $i + 1), Position::fromTopLeft(5, $i + 2),
                ],
            ];
        }
    }
}
