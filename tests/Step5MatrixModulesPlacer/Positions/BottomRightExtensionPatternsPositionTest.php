<?php

namespace Tests\Step5MatrixModulesPlacer\Positions;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\BottomRightExtensionPatternsPositions;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\Position;

class BottomRightExtensionPatternsPositionTest extends TestCase
{
    private BottomRightExtensionPatternsPositions $positions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->positions = new BottomRightExtensionPatternsPositions();
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
        $positions = [new Position(0, 0), new Position(0, 1), new Position(1, 0),  new Position(1, 1)];
        foreach (Version::all() as $version) {
            yield [$version, $positions];
        }
    }
}