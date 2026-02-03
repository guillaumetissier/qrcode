<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\FinderPatternCenterPositions;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;

class FinderPatternPositionsTest extends TestCase
{
    private FinderPatternCenterPositions $positions;

    protected function setUp(): void
    {
        $this->positions = new FinderPatternCenterPositions();
    }

    /**
     * @param Version $version
     * @param array<Position> $expectedPositions
     * @return void
     * @throws MissingInfoException
     * @dataProvider dataPositions
     */
    public function testGetPositions(Version $version, array $expectedPositions): void
    {
        $p = 0;
        foreach ($this->positions->withVersion($version)->positions() as $position) {
            $this->assertEquals($expectedPositions[$p++], $position);
        }
    }

    public static function dataPositions(): \Generator
    {
        yield [Version::V04, [Position::fromTopLeft(3, 3), Position::fromTopLeft(29, 3), Position::fromTopLeft(3, 29)]];
        yield [Version::V09, [Position::fromTopLeft(3, 3), Position::fromTopLeft(49, 3), Position::fromTopLeft(3, 49)]];
        yield [Version::V17, [Position::fromTopLeft(3, 3), Position::fromTopLeft(81, 3), Position::fromTopLeft(3, 81)]];
    }
}
