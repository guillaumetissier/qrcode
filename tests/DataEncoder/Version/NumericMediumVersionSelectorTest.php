<?php

namespace Tests\DataEncoder\Version;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Version\NumericMediumVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class NumericMediumVersionSelectorTest extends TestCase
{
    private NumericMediumVersionSelector $selector;

    public function setUp(): void
    {
        $this->selector = new NumericMediumVersionSelector();
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
            [34, 1],
            [63, 2],
            [101, 3],
            [149, 4],
            [202, 5],
            [255, 6],
            [293, 7],
            [365, 8],
            [432, 9],
            [513, 10],
            [604, 11],
            [691, 12],
            [796, 13],
            [871, 14],
            [991, 15],
            [1082, 16],
            [1212, 17],
            [1346, 18],
            [1500, 19],
            [1600, 20],
            [1708, 21],
            [1872, 22],
            [2059, 23],
            [2188, 24],
            [2395, 25],
            [2544, 26],
            [2701, 27],
            [2857, 28],
            [3035, 29],
            [3289, 30],
            [3486, 31],
            [3693, 32],
            [3909, 33],
            [4134, 34],
            [4343, 35],
            [4588, 36],
            [4775, 37],
            [5039, 38],
            [5313, 39],
            [5596, 40],
        ];
    }
}
