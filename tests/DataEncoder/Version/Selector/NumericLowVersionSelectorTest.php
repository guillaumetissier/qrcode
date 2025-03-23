<?php

namespace Tests\DataEncoder\Version\Selector;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\NumericLowVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Exception\DataTooVoluminous;

class NumericLowVersionSelectorTest extends LoggerTestCase
{
    private NumericLowVersionSelector $selector;

    public function setUp(): void
    {
        parent::setUp();

        $this->selector = new NumericLowVersionSelector($this->logger);
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
            [41, Version::V01],
            [42, Version::V02],
            [77, Version::V02],
            [78, Version::V03],
            [127, Version::V03],
            [128, Version::V04],
            [187, Version::V04],
            [188, Version::V05],
            [255, Version::V05],
            [256, Version::V06],
            [322, Version::V06],
            [323, Version::V07],
            [370, Version::V07],
            [371, Version::V08],
            [461, Version::V08],
            [462, Version::V09],
            [552, Version::V09],
            [553, Version::V10],
            [652, Version::V10],
            [653, Version::V11],
            [772, Version::V11],
            [773, Version::V12],
            [883, Version::V12],
            [884, Version::V13],
            [1022, Version::V13],
            [1023, Version::V14],
            [1101, Version::V14],
            [1102, Version::V15],
            [1250, Version::V15],
            [1251, Version::V16],
            [1408, Version::V16],
            [1409, Version::V17],
            [1548, Version::V17],
            [1549, Version::V18],
            [1725, Version::V18],
            [1726, Version::V19],
            [1903, Version::V19],
            [1904, Version::V20],
            [2061, Version::V20],
            [2062, Version::V21],
            [2232, Version::V21],
            [2233, Version::V22],
            [2409, Version::V22],
            [2410, Version::V23],
            [2620, Version::V23],
            [2621, Version::V24],
            [2812, Version::V24],
            [2813, Version::V25],
            [3057, Version::V25],
            [3058, Version::V26],
            [3283, Version::V26],
            [3284, Version::V27],
            [3517, Version::V27],
            [3518, Version::V28],
            [3669, Version::V28],
            [3670, Version::V29],
            [3909, Version::V29],
            [3910, Version::V30],
            [4158, Version::V30],
            [4159, Version::V31],
            [4417, Version::V31],
            [4418, Version::V32],
            [4686, Version::V32],
            [4687, Version::V33],
            [4965, Version::V33],
            [4966, Version::V34],
            [5253, Version::V34],
            [5254, Version::V35],
            [5529, Version::V35],
            [5530, Version::V36],
            [5836, Version::V36],
            [5837, Version::V37],
            [6153, Version::V37],
            [6154, Version::V38],
            [6479, Version::V38],
            [6480, Version::V39],
            [6743, Version::V39],
            [6744, Version::V40],
            [7089, Version::V40],
        ];
    }

    public function testVersionSelectorLimitMax(): void
    {
        $this->expectException(DataTooVoluminous::class);

        $this->selector->selectVersion(7090);
    }
}
