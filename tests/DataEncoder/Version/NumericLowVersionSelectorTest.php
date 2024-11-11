<?php

namespace Tests\DataEncoder\Version;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Version\NumericLowVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class NumericLowVersionSelectorTest extends TestCase
{
    private NumericLowVersionSelector $selector;

    public function setUp(): void
    {
        $this->selector = new NumericLowVersionSelector();
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
            [41, 1],
            [77, 2],
            [127, 3],
            [187, 4],
            [255, 5],
            [322, 6],
            [370, 7],
            [461, 8],
            [552, 9],
            [652, 10],
            [772, 11],
            [883, 12],
            [1022, 13],
            [1101, 14],
            [1250, 15],
            [1408, 16],
            [1548, 17],
            [1725, 18],
            [1903, 19],
            [2061, 20],
            [2232, 21],
            [2409, 22],
            [2620, 23],
            [2812, 24],
            [3057, 25],
            [3283, 26],
            [3517, 27],
            [3669, 28],
            [3909, 29],
            [4158, 30],
            [4417, 31],
            [4686, 32],
            [4965, 33],
            [5253, 34],
            [5529, 35],
            [5836, 36],
            [6153, 37],
            [6479, 38],
            [6743, 39],
            [7089, 40],
        ];
    }
}
