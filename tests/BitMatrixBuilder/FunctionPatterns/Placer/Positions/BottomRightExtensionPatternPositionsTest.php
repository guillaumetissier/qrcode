<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\BottomRightExtensionPatternPositions;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;

final class BottomRightExtensionPatternPositionsTest extends TestCase
{
    private BottomRightExtensionPatternPositions $positions;

    protected function setUp(): void
    {
        $this->positions = new BottomRightExtensionPatternPositions();
    }

    /**
     * @param Version $version
     * @param array<Position> $expectedPositions
     * @return void
     * @throws MissingInfoException
     * @dataProvider dataPositions
     */
    public function testPositions(Version $version, array $expectedPositions): void
    {
        $p = 0;
        foreach ($this->positions->withVersion($version)->positions() as $position) {
            $this->assertEquals($expectedPositions[$p++], $position);
        }
    }

    public static function dataPositions(): \Generator
    {
        yield [
            Version::V01,
            [
                Position::fromTopLeft(20, 20),
                Position::fromTopLeft(20, 19),
                Position::fromTopLeft(19, 20),
                Position::fromTopLeft(19, 19),
            ]
        ];

        yield [
            Version::V04,
            [
                Position::fromTopLeft(32, 32),
                Position::fromTopLeft(32, 31),
                Position::fromTopLeft(31, 32),
                Position::fromTopLeft(31, 31),
            ]
        ];

        yield [
            Version::V08,
            [
                Position::fromTopLeft(48, 48),
                Position::fromTopLeft(48, 47),
                Position::fromTopLeft(47, 48),
                Position::fromTopLeft(47, 47),
            ]
        ];
    }
}
