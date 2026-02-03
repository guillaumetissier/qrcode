<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataAnalyser\Version\Selector;

use Guillaumetissier\QrCode\Tests\Logger\LoggerTestCase;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\ByteLowVersionSelector;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\DataTooVoluminous;

class ByteLowVersionSelectorTest extends LoggerTestCase
{
    private ByteLowVersionSelector $selector;

    public function setUp(): void
    {
        parent::setUp();

        $this->selector = new ByteLowVersionSelector($this->logger);
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
            [17, Version::V01],
            [18, Version::V02],
            [32, Version::V02],
            [33, Version::V03],
            [53, Version::V03],
            [54, Version::V04],
            [78, Version::V04],
            [79, Version::V05],
            [106, Version::V05],
            [107, Version::V06],
            [134, Version::V06],
            [135, Version::V07],
            [154, Version::V07],
            [155, Version::V08],
            [192, Version::V08],
            [193, Version::V09],
            [230, Version::V09],
            [231, Version::V10],
            [271, Version::V10],
            [272, Version::V11],
            [321, Version::V11],
            [322, Version::V12],
            [367, Version::V12],
            [368, Version::V13],
            [425, Version::V13],
            [426, Version::V14],
            [458, Version::V14],
            [459, Version::V15],
            [520, Version::V15],
            [521, Version::V16],
            [586, Version::V16],
            [587, Version::V17],
            [644, Version::V17],
            [645, Version::V18],
            [718, Version::V18],
            [719, Version::V19],
            [792, Version::V19],
            [793, Version::V20],
            [858, Version::V20],
            [859, Version::V21],
            [929, Version::V21],
            [930, Version::V22],
            [1003, Version::V22],
            [1004, Version::V23],
            [1091, Version::V23],
            [1092, Version::V24],
            [1171, Version::V24],
            [1172, Version::V25],
            [1273, Version::V25],
            [1274, Version::V26],
            [1367, Version::V26],
            [1368, Version::V27],
            [1465, Version::V27],
            [1466, Version::V28],
            [1528, Version::V28],
            [1529, Version::V29],
            [1628, Version::V29],
            [1629, Version::V30],
            [1732, Version::V30],
            [1733, Version::V31],
            [1840, Version::V31],
            [1841, Version::V32],
            [1952, Version::V32],
            [1953, Version::V33],
            [2068, Version::V33],
            [2069, Version::V34],
            [2188, Version::V34],
            [2189, Version::V35],
            [2303, Version::V35],
            [2304, Version::V36],
            [2431, Version::V36],
            [2432, Version::V37],
            [2563, Version::V37],
            [2564, Version::V38],
            [2699, Version::V38],
            [2700, Version::V39],
            [2809, Version::V39],
            [2810, Version::V40],
            [2953, Version::V40],
        ];
    }

    public function testVersionSelectorLimitMax(): void
    {
        $this->expectException(DataTooVoluminous::class);

        $this->selector->selectVersion(2954);
    }
}
