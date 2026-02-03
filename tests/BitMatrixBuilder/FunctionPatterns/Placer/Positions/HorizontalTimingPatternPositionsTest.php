<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\HorizontalTimingPatternPositions;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;

final class HorizontalTimingPatternPositionsTest extends TestCase
{
    private HorizontalTimingPatternPositions $positions;

    protected function setUp(): void
    {
        $this->positions = new HorizontalTimingPatternPositions();
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
        $positions = [];
        $size = 17;
        for ($col = 0; $col < $size; $col++) {
            $positions[] = Position::fromTopLeft($col, 6);
        }

        foreach (Version::all() as $version) {
            for ($col = 0; $col < 4; $col++) {
                $positions[] = Position::fromTopLeft($size + $col, 6);
            }
            $size += 4;
            yield [$version, $positions];
        }
    }
}
