<?php

namespace Tests\DataEncoder\Version\Selector;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\NumericHighVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Exception\DataTooVoluminous;

class NumericHighVersionSelectorTest extends LoggerTestCase
{
    private NumericHighVersionSelector $selector;

    public function setUp(): void
    {
        parent::setUp();

        $this->selector = new NumericHighVersionSelector($this->logger);
    }

    /**
     * @throws \Exception
     * @dataProvider provideDataForSelectVersion
     */
    public function testSelectVersion(int $dataLength, Version $expectedVersion): void
    {
        $this->assertEquals($expectedVersion, $this->selector->selectVersion($dataLength));
    }

    public static function provideDataForSelectVersion(): array
    {
        return [
            [1, Version::V01],
            [17, Version::V01],
            [18, Version::V02],
            [34, Version::V02],
            [35, Version::V03],
            [58, Version::V03],
            [59, Version::V04],
            [82, Version::V04],
            [83, Version::V05],
            [106, Version::V05],
            [107, Version::V06],
            [139, Version::V06],
            [140, Version::V07],
            [154, Version::V07],
            [155, Version::V08],
            [202, Version::V08],
            [203, Version::V09],
            [235, Version::V09],
            [236, Version::V10],
            [288, Version::V10],
            [289, Version::V11],
            [331, Version::V11],
            [332, Version::V12],
            [374, Version::V12],
            [375, Version::V13],
            [427, Version::V13],
            [428, Version::V14],
            [468, Version::V14],
            [469, Version::V15],
            [530, Version::V15],
            [531, Version::V16],
            [602, Version::V16],
            [603, Version::V17],
            [674, Version::V17],
            [675, Version::V18],
            [746, Version::V18],
            [747, Version::V19],
            [813, Version::V19],
            [814, Version::V20],
            [919, Version::V20],
            [920, Version::V21],
            [969, Version::V21],
            [970, Version::V22],
            [1056, Version::V22],
            [1057, Version::V23],
            [1108, Version::V23],
            [1109, Version::V24],
            [1228, Version::V24],
            [1229, Version::V25],
            [1286, Version::V25],
            [1287, Version::V26],
            [1425, Version::V26],
            [1426, Version::V27],
            [1501, Version::V27],
            [1502, Version::V28],
            [1581, Version::V28],
            [1582, Version::V29],
            [1677, Version::V29],
            [1678, Version::V30],
            [1782, Version::V30],
            [1783, Version::V31],
            [1897, Version::V31],
            [1898, Version::V32],
            [2022, Version::V32],
            [2023, Version::V33],
            [2157, Version::V33],
            [2158, Version::V34],
            [2301, Version::V34],
            [2302, Version::V35],
            [2361, Version::V35],
            [2362, Version::V36],
            [2524, Version::V36],
            [2525, Version::V37],
            [2625, Version::V37],
            [2626, Version::V38],
            [2735, Version::V38],
            [2736, Version::V39],
            [2927, Version::V39],
            [2928, Version::V40],
            [3057, Version::V40],
        ];
    }

    public function testVersionSelectorLimitMax(): void
    {
        $this->expectException(DataTooVoluminous::class);

        $this->selector->selectVersion(3058);
    }
}
