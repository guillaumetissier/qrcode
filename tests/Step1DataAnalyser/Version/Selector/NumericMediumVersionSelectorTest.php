<?php

namespace Tests\Step1DataAnalyser\Version\Selector;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Selector\NumericMediumVersionSelector;
use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;
use ThePhpGuild\QrCode\Exception\DataTooVoluminous;

class NumericMediumVersionSelectorTest extends LoggerTestCase
{
    private NumericMediumVersionSelector $selector;

    public function setUp(): void
    {
        parent::setUp();

        $this->selector = new NumericMediumVersionSelector($this->logger);
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
            [34, Version::V01],
            [35, Version::V02],
            [63, Version::V02],
            [64, Version::V03],
            [101, Version::V03],
            [102, Version::V04],
            [149, Version::V04],
            [150, Version::V05],
            [202, Version::V05],
            [203, Version::V06],
            [255, Version::V06],
            [256, Version::V07],
            [293, Version::V07],
            [294, Version::V08],
            [365, Version::V08],
            [366, Version::V09],
            [432, Version::V09],
            [433, Version::V10],
            [513, Version::V10],
            [514, Version::V11],
            [604, Version::V11],
            [605, Version::V12],
            [691, Version::V12],
            [692, Version::V13],
            [796, Version::V13],
            [797, Version::V14],
            [871, Version::V14],
            [872, Version::V15],
            [991, Version::V15],
            [992, Version::V16],
            [1082, Version::V16],
            [1083, Version::V17],
            [1212, Version::V17],
            [1213, Version::V18],
            [1346, Version::V18],
            [1347, Version::V19],
            [1500, Version::V19],
            [1501, Version::V20],
            [1600, Version::V20],
            [1601, Version::V21],
            [1708, Version::V21],
            [1709, Version::V22],
            [1872, Version::V22],
            [1873, Version::V23],
            [2059, Version::V23],
            [2060, Version::V24],
            [2188, Version::V24],
            [2189, Version::V25],
            [2395, Version::V25],
            [2396, Version::V26],
            [2544, Version::V26],
            [2545, Version::V27],
            [2701, Version::V27],
            [2702, Version::V28],
            [2857, Version::V28],
            [2858, Version::V29],
            [3035, Version::V29],
            [3036, Version::V30],
            [3289, Version::V30],
            [3290, Version::V31],
            [3486, Version::V31],
            [3487, Version::V32],
            [3693, Version::V32],
            [3694, Version::V33],
            [3909, Version::V33],
            [3910, Version::V34],
            [4134, Version::V34],
            [4135, Version::V35],
            [4343, Version::V35],
            [4344, Version::V36],
            [4588, Version::V36],
            [4689, Version::V37],
            [4775, Version::V37],
            [4776, Version::V38],
            [5039, Version::V38],
            [5040, Version::V39],
            [5313, Version::V39],
            [5314, Version::V40],
            [5596, Version::V40],
        ];
    }

    public function testVersionSelectorLimitMax(): void
    {
        $this->expectException(DataTooVoluminous::class);

        $this->selector->selectVersion(5597);
    }
}
