<?php

namespace Tests\DataEncoder\Version;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Version\NumericHighVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class NumericHighVersionSelectorTest extends TestCase
{
    private NumericHighVersionSelector $selector;

    public function setUp(): void
    {
        $this->selector = new NumericHighVersionSelector();
    }

    /**
     * @throws \Exception
     * @dataProvider provideDataToTestVersionSelector
     */
    public function testVersionSelector(int $dataLength, int $expectedVersion): void
    {
        $this->assertEquals(
            Version::fromInt($expectedVersion),
            $this->selector->selectVersion($dataLength)
        );
    }

    static public function provideDataToTestVersionSelector(): array
    {
        return [
            [17, 1],
            [34, 2],
            [58, 3],
            [82, 4],
            [106, 5],
            [139, 6],
            [154, 7],
            [202, 8],
            [235, 9],
            [288, 10],
            [331, 11],
            [374, 12],
            [427, 13],
            [468, 14],
            [530, 15],
            [602, 16],
            [674, 17],
            [746, 18],
            [813, 19],
            [919, 20],
            [969, 21],
            [1056, 22],
            [1108, 23],
            [1228, 24],
            [1286, 25],
            [1425, 26],
            [1501, 27],
            [1581, 28],
            [1677, 29],
            [1782, 30],
            [1897, 31],
            [2022, 32],
            [2157, 33],
            [2301, 34],
            [2361, 35],
            [2524, 36],
            [2625, 37],
            [2735, 38],
            [2927, 39],
            [3057, 40],
        ];
    }
}
