<?php

namespace Tests\Step5MatrixModulesPlacer\Positions;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\ExtensionPatternsPositions;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\Position;

class ExtensionPatternsPositionTest extends TestCase
{
    private ExtensionPatternsPositions $positions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->positions = new ExtensionPatternsPositions();
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
        $positions = [new Position(0, 0)];
        yield [Version::V01, $positions];
        yield [Version::V02, self::addPositions($positions, 8)];
        yield [Version::V03, $positions];
        yield [Version::V04, self::addPositions($positions, 16)];
        yield [Version::V05, $positions];
        yield [Version::V06, self::addPositions($positions, 24)];
        yield [Version::V07, $positions];
        yield [Version::V08, self::addPositions($positions, 32)];
        yield [Version::V09, $positions];
        yield [Version::V10, self::addPositions($positions, 40)];
        yield [Version::V11, $positions];
        yield [Version::V12, self::addPositions($positions, 48)];
        yield [Version::V13, $positions];
        yield [Version::V14, self::addPositions($positions, 56)];
        yield [Version::V15, $positions];
        yield [Version::V16, self::addPositions($positions, 64)];
        yield [Version::V17, $positions];
        yield [Version::V18, self::addPositions($positions, 72)];
        yield [Version::V19, $positions];
        yield [Version::V20, self::addPositions($positions, 80)];
        yield [Version::V21, $positions];
        yield [Version::V22, self::addPositions($positions, 88)];
        yield [Version::V23, $positions];
        yield [Version::V24, self::addPositions($positions, 96)];
        yield [Version::V25, $positions];
        yield [Version::V26, self::addPositions($positions, 104)];
        yield [Version::V27, $positions];
        yield [Version::V28, self::addPositions($positions, 112)];
        yield [Version::V29, $positions];
        yield [Version::V30, self::addPositions($positions, 120)];
        yield [Version::V31, $positions];
        yield [Version::V32, self::addPositions($positions, 128)];
        yield [Version::V33, $positions];
        yield [Version::V34, self::addPositions($positions, 136)];
        yield [Version::V35, $positions];
        yield [Version::V36, self::addPositions($positions, 144)];
        yield [Version::V37, $positions];
        yield [Version::V38, self::addPositions($positions, 152)];
        yield [Version::V39, $positions];
        yield [Version::V40, self::addPositions($positions, 160)];
    }

    private static function addPositions(array &$positions, $newPos): array
    {
        $positions[] = new Position($newPos, 0);
        $positions[] = new Position(0, $newPos);

        return $positions;
    }
}