<?php

namespace Tests\Step5MatrixModulesPlacer\Positions;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\BottomExtensionPatternsPositions;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\Position;

class BottomExtensionPatternsPositionTest extends TestCase
{
    private BottomExtensionPatternsPositions $positions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->positions = new BottomExtensionPatternsPositions();
    }

    /**
     * @dataProvider provideDataToTestGetPositions
     */
    public function testGetPositions(Version $version, array $expectedPositions): void
    {
        $p = 0;
        foreach ($this->positions->setVersion($version)->getPositions() as $position) {
            $this->assertEquals($expectedPositions[$p++], $position);
        }
    }

    public static function provideDataToTestGetPositions(): \Generator
    {
        $positions = [];
        foreach (Version::all() as $version) {
            if ($version === Version::V01) {
                continue;
            }
            if ($version->value % 2 === 0) {
                $col = $version->value * 4;
                $positions[] = new Position($col, 0);
                $positions[] = new Position($col, 1);
                $positions[] = new Position($col + 1, 0);
                $positions[] = new Position($col + 1, 1);
                $positions[] = new Position($col + 2, 0);
                $positions[] = new Position($col + 2, 1);
                $positions[] = new Position($col + 3, 0);
                $positions[] = new Position($col + 3, 1);
            }
            yield [$version, $positions];
        }
    }
}