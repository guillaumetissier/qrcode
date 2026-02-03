<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\BottomExtensionPatternPositions;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use PHPUnit\Framework\TestCase;

final class BottomExtensionPatternPositionsTest extends TestCase
{
    private BottomExtensionPatternPositions $positions;

    protected function setUp(): void
    {
        $this->positions = new BottomExtensionPatternPositions();
    }

    /**
     * @dataProvider provideDataToTestGetPositions
     */
    public function testGetPositions(Version $version, array $expectedPositionsFromBottomRight): void
    {
        $p = 0;
        foreach ($this->positions->withVersion($version)->positions() as $position) {
            $this->assertEquals(
                Position::fromBottomRight(
                    $expectedPositionsFromBottomRight[$p]['col'],
                    $expectedPositionsFromBottomRight[$p]['row'],
                    $version->size()
                ),
                $position
            );
            $p++;
        }
    }

    public static function provideDataToTestGetPositions(): \Generator
    {
        $positionsFromBottomRight = [];
        foreach (Version::all() as $version) {
            if ($version === Version::V01) {
                continue;
            }
            if ($version->value % 2 === 0) {
                $col = $version->value * 4;
                $positionsFromBottomRight[] = ['col' => $col, 'row' => 0];
                $positionsFromBottomRight[] = ['col' => $col, 'row' => 1];
                $positionsFromBottomRight[] = ['col' => $col + 1, 'row' => 0];
                $positionsFromBottomRight[] = ['col' => $col + 1, 'row' => 1];
                $positionsFromBottomRight[] = ['col' => $col + 2, 'row' => 0];
                $positionsFromBottomRight[] = ['col' => $col + 2, 'row' => 1];
                $positionsFromBottomRight[] = ['col' => $col + 3, 'row' => 0];
                $positionsFromBottomRight[] = ['col' => $col + 3, 'row' => 1];
            }
            yield [$version, $positionsFromBottomRight];
        }
    }
}
