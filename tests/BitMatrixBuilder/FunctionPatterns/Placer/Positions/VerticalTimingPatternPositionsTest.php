<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\VerticalTimingPatternPositions;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;

final class VerticalTimingPatternPositionsTest extends TestCase
{
    private VerticalTimingPatternPositions $positions;

    protected function setUp(): void
    {
        $this->positions = new VerticalTimingPatternPositions();
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
        $expectedPositions = [];
        $size = 17;
        for ($row = 0; $row < $size; $row++) {
            $expectedPositions[] = Position::fromTopLeft(6, $row);
        }

        foreach (Version::all() as $version) {
            for ($row = 0; $row < 4; $row++) {
                $expectedPositions[] = Position::fromTopLeft(6, $size + $row);
            }
            $size += 4;
            yield [$version, $expectedPositions];
        }
    }
}
