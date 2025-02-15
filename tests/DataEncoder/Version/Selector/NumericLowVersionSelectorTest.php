<?php

namespace Tests\DataEncoder\Version\Selector;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\NumericLowVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\DataEncoder\Version\VersionFromIntConverter;

class NumericLowVersionSelectorTest extends TestCase
{
    private NumericLowVersionSelector $selector;

    public function setUp(): void
    {
        $this->selector = new NumericLowVersionSelector(new VersionFromIntConverter());
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
            [41, Version::V01],
            [77, Version::V02],
            [127, Version::V03],
            [187, Version::V04],
            [255, Version::V05],
            [322, Version::V06],
            [370, Version::V07],
            [461, Version::V08],
            [552, Version::V09],
            [652, Version::V10],
            [772, Version::V11],
            [883, Version::V12],
            [1022, Version::V13],
            [1101, Version::V14],
            [1250, Version::V15],
            [1408, Version::V16],
            [1548, Version::V17],
            [1725, Version::V18],
            [1903, Version::V19],
            [2061, Version::V20],
            [2232, Version::V21],
            [2409, Version::V22],
            [2620, Version::V23],
            [2812, Version::V24],
            [3057, Version::V25],
            [3283, Version::V26],
            [3517, Version::V27],
            [3669, Version::V28],
            [3909, Version::V29],
            [4158, Version::V30],
            [4417, Version::V31],
            [4686, Version::V32],
            [4965, Version::V33],
            [5253, Version::V34],
            [5529, Version::V35],
            [5836, Version::V36],
            [6153, Version::V37],
            [6479, Version::V38],
            [6743, Version::V39],
            [7089, Version::V40],
        ];
    }
}
