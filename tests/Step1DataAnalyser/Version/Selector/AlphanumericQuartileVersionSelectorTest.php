<?php

namespace Tests\Step1DataAnalyser\Version\Selector;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Exception\DataTooVoluminous;
use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Selector\AlphanumericQuartileVersionSelector;

class AlphanumericQuartileVersionSelectorTest extends LoggerTestCase
{
    private AlphanumericQuartileVersionSelector $selector;

    public function setUp(): void
    {
        parent::setUp();

        $this->selector = new AlphanumericQuartileVersionSelector($this->logger);
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
            [16, Version::V01],
            [17, Version::V02],
            [29, Version::V02],
            [30, Version::V03],
            [47, Version::V03],
            [48, Version::V04],
            [67, Version::V04],
            [68, Version::V05],
            [87, Version::V05],
            [88, Version::V06],
            [108, Version::V06],
            [109, Version::V07],
            [125, Version::V07],
            [126, Version::V08],
            [157, Version::V08],
            [158, Version::V09],
            [189, Version::V09],
            [190, Version::V10],
            [221, Version::V10],
            [222, Version::V11],
            [259, Version::V11],
            [260, Version::V12],
            [296, Version::V12],
            [297, Version::V13],
            [352, Version::V13],
            [353, Version::V14],
            [376, Version::V14],
            [377, Version::V15],
            [426, Version::V15],
            [427, Version::V16],
            [470, Version::V16],
            [471, Version::V17],
            [531, Version::V17],
            [532, Version::V18],
            [574, Version::V18],
            [575, Version::V19],
            [644, Version::V19],
            [645, Version::V20],
            [702, Version::V20],
            [703, Version::V21],
            [742, Version::V21],
            [743, Version::V22],
            [823, Version::V22],
            [824, Version::V23],
            [890, Version::V23],
            [891, Version::V24],
            [963, Version::V24],
            [964, Version::V25],
            [1041, Version::V25],
            [1042, Version::V26],
            [1094, Version::V26],
            [1095, Version::V27],
            [1172, Version::V27],
            [1173, Version::V28],
            [1263, Version::V28],
            [1264, Version::V29],
            [1322, Version::V29],
            [1323, Version::V30],
            [1429, Version::V30],
            [1430, Version::V31],
            [1499, Version::V31],
            [1500, Version::V32],
            [1618, Version::V32],
            [1619, Version::V33],
            [1700, Version::V33],
            [1701, Version::V34],
            [1787, Version::V34],
            [1788, Version::V35],
            [1867, Version::V35],
            [1868, Version::V36],
            [1966, Version::V36],
            [1967, Version::V37],
            [2071, Version::V37],
            [2072, Version::V38],
            [2181, Version::V38],
            [2182, Version::V39],
            [2298, Version::V39],
            [2299, Version::V40],
            [2420, Version::V40],
        ];
    }

    public function testVersionSelectorLimitMax(): void
    {
        $this->expectException(DataTooVoluminous::class);

        $this->selector->selectVersion(2421);
    }
}
