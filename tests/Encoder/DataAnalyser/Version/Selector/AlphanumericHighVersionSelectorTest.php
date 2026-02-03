<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataAnalyser\Version\Selector;

use Exception;
use Guillaumetissier\QrCode\Tests\Logger\LoggerTestCase;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\AlphanumericHighVersionSelector;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\DataTooVoluminous;

class AlphanumericHighVersionSelectorTest extends LoggerTestCase
{
    private AlphanumericHighVersionSelector $selector;

    public function setUp(): void
    {
        parent::setUp();

        $this->selector = new AlphanumericHighVersionSelector($this->logger);
    }

    /**
     * @throws Exception
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
            [10, Version::V01],
            [11, Version::V02],
            [20, Version::V02],
            [21, Version::V03],
            [35, Version::V03],
            [49, Version::V04],
            [50, Version::V04],
            [51, Version::V05],
            [64, Version::V05],
            [65, Version::V06],
            [84, Version::V06],
            [85, Version::V07],
            [93, Version::V07],
            [94, Version::V08],
            [122, Version::V08],
            [123, Version::V09],
            [143, Version::V09],
            [144, Version::V10],
            [174, Version::V10],
            [175, Version::V11],
            [200, Version::V11],
            [201, Version::V12],
            [227, Version::V12],
            [228, Version::V13],
            [259, Version::V13],
            [260, Version::V14],
            [283, Version::V14],
            [284, Version::V15],
            [321, Version::V15],
            [322, Version::V16],
            [365, Version::V16],
            [366, Version::V17],
            [408, Version::V17],
            [409, Version::V18],
            [452, Version::V18],
            [453, Version::V19],
            [493, Version::V19],
            [494, Version::V20],
            [557, Version::V20],
            [558, Version::V21],
            [587, Version::V21],
            [588, Version::V22],
            [640, Version::V22],
            [641, Version::V23],
            [672, Version::V23],
            [673, Version::V24],
            [744, Version::V24],
            [745, Version::V25],
            [779, Version::V25],
            [780, Version::V26],
            [864, Version::V26],
            [865, Version::V27],
            [910, Version::V27],
            [911, Version::V28],
            [958, Version::V28],
            [959, Version::V29],
            [1016, Version::V29],
            [1017, Version::V30],
            [1080, Version::V30],
            [1081, Version::V31],
            [1150, Version::V31],
            [1151, Version::V32],
            [1226, Version::V32],
            [1227, Version::V33],
            [1307, Version::V33],
            [1308, Version::V34],
            [1394, Version::V34],
            [1395, Version::V35],
            [1431, Version::V35],
            [1432, Version::V36],
            [1530, Version::V36],
            [1531, Version::V37],
            [1591, Version::V37],
            [1592, Version::V38],
            [1658, Version::V38],
            [1659, Version::V39],
            [1774, Version::V39],
            [1775, Version::V40],
            [1852, Version::V40],
        ];
    }

    public function testVersionSelectorLimitMax(): void
    {
        $this->expectException(DataTooVoluminous::class);

        $this->selector->selectVersion(1853);
    }
}
