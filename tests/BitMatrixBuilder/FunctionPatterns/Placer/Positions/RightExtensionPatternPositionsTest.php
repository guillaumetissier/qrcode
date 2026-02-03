<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\RightExtensionPatternPositions;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;

final class RightExtensionPatternPositionsTest extends TestCase
{
    private RightExtensionPatternPositions $positions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->positions = new RightExtensionPatternPositions();
    }

    /**
     * @param list<array{col: int, row:int}> $expectedPositionsFromBottomRight
     * @throws MissingInfoException
     *
     * @dataProvider provideDataToTestGetPositions
     */
    public function testGetPositions(Version $version, array $expectedPositionsFromBottomRight): void
    {
        $p = 0;
        $size = $version->size();
        foreach ($this->positions->withVersion($version)->positions() as $position) {
            $this->assertEquals(
                Position::fromBottomRight(
                    $expectedPositionsFromBottomRight[$p]['col'],
                    $expectedPositionsFromBottomRight[$p]['row'],
                    $size
                ),
                $position
            );
            $p++;
        }
    }

    public static function provideDataToTestGetPositions(): \Generator
    {
        $expectedPositionsFromBottomRight = [];
        foreach (Version::all() as $version) {
            if ($version === Version::V01) {
                continue;
            }
            if ($version->value % 2 === 0) {
                $row = $version->value * 4;
                $expectedPositionsFromBottomRight[] = ['col' => 0, 'row' => $row];
                $expectedPositionsFromBottomRight[] = ['col' => 1, 'row' => $row];
                $expectedPositionsFromBottomRight[] = ['col' => 0, 'row' => $row + 1];
                $expectedPositionsFromBottomRight[] = ['col' => 1, 'row' => $row + 1];
                $expectedPositionsFromBottomRight[] = ['col' => 0, 'row' => $row + 2];
                $expectedPositionsFromBottomRight[] = ['col' => 1, 'row' => $row + 2];
                $expectedPositionsFromBottomRight[] = ['col' => 0, 'row' => $row + 3];
                $expectedPositionsFromBottomRight[] = ['col' => 1, 'row' => $row + 3];
            }
            yield [$version, $expectedPositionsFromBottomRight];
        }
    }
}
