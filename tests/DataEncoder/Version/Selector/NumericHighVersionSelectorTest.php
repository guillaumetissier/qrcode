<?php

namespace Tests\DataEncoder\Version\Selector;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\NumericHighVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\DataEncoder\Version\VersionFromIntConverter;

class NumericHighVersionSelectorTest extends TestCase
{
    private NumericHighVersionSelector $selector;

    public function setUp(): void
    {
        $this->selector = new NumericHighVersionSelector(new VersionFromIntConverter());
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
            [17, Version::V01],
            [34, Version::V02],
            [58, Version::V03],
            [82, Version::V04],
            [106, Version::V05],
            [139, Version::V06],
            [154, Version::V07],
            [202, Version::V08],
            [235, Version::V09],
            [288, Version::V10],
            [331, Version::V11],
            [374, Version::V12],
            [427, Version::V13],
            [468, Version::V14],
            [530, Version::V15],
            [602, Version::V16],
            [674, Version::V17],
            [746, Version::V18],
            [813, Version::V19],
            [919, Version::V20],
            [969, Version::V21],
            [1056, Version::V22],
            [1108, Version::V23],
            [1228, Version::V24],
            [1286, Version::V25],
            [1425, Version::V26],
            [1501, Version::V27],
            [1581, Version::V28],
            [1677, Version::V29],
            [1782, Version::V30],
            [1897, Version::V31],
            [2022, Version::V32],
            [2157, Version::V33],
            [2301, Version::V34],
            [2361, Version::V35],
            [2524, Version::V36],
            [2625, Version::V37],
            [2735, Version::V38],
            [2927, Version::V39],
            [3057, Version::V40],
        ];
    }
}
