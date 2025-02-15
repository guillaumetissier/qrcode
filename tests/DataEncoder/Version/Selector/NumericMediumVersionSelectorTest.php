<?php

namespace Tests\DataEncoder\Version\Selector;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\NumericMediumVersionSelector;
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
    public function testVersionSelector(int $dataLength, Version $expectedVersion): void
    {
        $this->assertEquals($expectedVersion, $this->selector->selectVersion($dataLength));
    }

    static public function provideDataToTestVersionSelector(): array
    {
        return [
            [34, Version::V01],
            [63, Version::V02],
            [101, Version::V03],
            [149, Version::V04],
            [202, Version::V05],
            [255, Version::V06],
            [293, Version::V07],
            [365, Version::V08],
            [432, Version::V09],
            [513, Version::V10],
            [604, Version::V11],
            [691, Version::V12],
            [796, Version::V13],
            [871, Version::V14],
            [991, Version::V15],
            [1082, Version::V16],
            [1212, Version::V17],
            [1346, Version::V18],
            [1500, Version::V19],
            [1600, Version::V20],
            [1708, Version::V21],
            [1872, Version::V22],
            [2059, Version::V23],
            [2188, Version::V24],
            [2395, Version::V25],
            [2544, Version::V26],
            [2701, Version::V27],
            [2857, Version::V28],
            [3035, Version::V29],
            [3289, Version::V30],
            [3486, Version::V31],
            [3693, Version::V32],
            [3909, Version::V33],
            [4134, Version::V34],
            [4343, Version::V35],
            [4588, Version::V36],
            [4775, Version::V37],
            [5039, Version::V38],
            [5313, Version::V39],
            [5596, Version::V40],
        ];
    }
}
