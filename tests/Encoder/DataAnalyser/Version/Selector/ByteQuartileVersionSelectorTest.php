<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataAnalyser\Version\Selector;

use Guillaumetissier\QrCode\Tests\Logger\LoggerTestCase;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\ByteQuartileVersionSelector;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\DataTooVoluminous;

class ByteQuartileVersionSelectorTest extends LoggerTestCase
{
    private ByteQuartileVersionSelector $selector;

    public function setUp(): void
    {
        parent::setUp();

        $this->selector = new ByteQuartileVersionSelector($this->logger);
    }

    /**
     * @throws \Exception
     * @dataProvider provideDataForSelectVersion
     */
    public function testSelectVersion(int $dataLength, Version $expectedVersion): void
    {
        $this->assertEquals($expectedVersion, $this->selector->selectVersion($dataLength));
    }

    /**
     * @return array<array{int, Version}>
     */
    public static function provideDataForSelectVersion(): array
    {
        return [
            [1, Version::V01],
            [11, Version::V01],
            [12, Version::V02],
            [20, Version::V02],
            [21, Version::V03],
            [32, Version::V03],
            [33, Version::V04],
            [46, Version::V04],
            [47, Version::V05],
            [60, Version::V05],
            [61, Version::V06],
            [74, Version::V06],
            [75, Version::V07],
            [86, Version::V07],
            [87, Version::V08],
            [108, Version::V08],
            [109, Version::V09],
            [130, Version::V09],
            [131, Version::V10],
            [151, Version::V10],
            [152, Version::V11],
            [177, Version::V11],
            [178, Version::V12],
            [203, Version::V12],
            [204, Version::V13],
            [241, Version::V13],
            [242, Version::V14],
            [258, Version::V14],
            [259, Version::V15],
            [292, Version::V15],
            [293, Version::V16],
            [322, Version::V16],
            [323, Version::V17],
            [364, Version::V17],
            [365, Version::V18],
            [394, Version::V18],
            [395, Version::V19],
            [442, Version::V19],
            [443, Version::V20],
            [482, Version::V20],
            [483, Version::V21],
            [509, Version::V21],
            [510, Version::V22],
            [565, Version::V22],
            [566, Version::V23],
            [611, Version::V23],
            [612, Version::V24],
            [661, Version::V24],
            [662, Version::V25],
            [715, Version::V25],
            [716, Version::V26],
            [751, Version::V26],
            [752, Version::V27],
            [805, Version::V27],
            [806, Version::V28],
            [868, Version::V28],
            [869, Version::V29],
            [908, Version::V29],
            [909, Version::V30],
            [982, Version::V30],
            [983, Version::V31],
            [1030, Version::V31],
            [1031, Version::V32],
            [1112, Version::V32],
            [1113, Version::V33],
            [1168, Version::V33],
            [1169, Version::V34],
            [1228, Version::V34],
            [1229, Version::V35],
            [1283, Version::V35],
            [1284, Version::V36],
            [1351, Version::V36],
            [1352, Version::V37],
            [1423, Version::V37],
            [1424, Version::V38],
            [1499, Version::V38],
            [1500, Version::V39],
            [1579, Version::V39],
            [1580, Version::V40],
            [1663, Version::V40],
        ];
    }

    public function testVersionSelectorLimitMax(): void
    {
        $this->expectException(DataTooVoluminous::class);

        $this->selector->selectVersion(1664);
    }
}
