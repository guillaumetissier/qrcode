<?php

namespace Tests\Step5MatrixModulesPlacer\Positions;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\Position;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\RightExtensionPatternsPositions;

class RightExtensionPatternsPositionTest extends TestCase
{
    private RightExtensionPatternsPositions $positions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->positions = new RightExtensionPatternsPositions();
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
                $row = $version->value * 4;
                $positions[] = new Position(0, $row);
                $positions[] = new Position(1, $row);
                $positions[] = new Position(0, $row + 1);
                $positions[] = new Position(1, $row + 1);
                $positions[] = new Position(0, $row + 2);
                $positions[] = new Position(1, $row + 2);
                $positions[] = new Position(0, $row + 3);
                $positions[] = new Position(1, $row + 3);
            }
            yield [$version, $positions];
        }
    }
}