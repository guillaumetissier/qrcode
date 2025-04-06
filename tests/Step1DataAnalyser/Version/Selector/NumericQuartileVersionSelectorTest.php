<?php

namespace Tests\Step1DataAnalyser\Version\Selector;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Selector\NumericQuartileVersionSelector;
use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;
use ThePhpGuild\QrCode\Exception\DataTooVoluminous;

class NumericQuartileVersionSelectorTest extends LoggerTestCase
{
    private NumericQuartileVersionSelector $selector;

    public function setUp(): void
    {
        parent::setUp();

        $this->selector = new NumericQuartileVersionSelector($this->logger);
    }

    /**
     * @throws \Exception
     * @dataProvider provideDataForSelectVersion
     */
    public function testSelectVersion(int $dataLength, Version $expectedVersion): void
    {
        $this->assertEquals($expectedVersion, $this->selector->selectVersion($dataLength));
    }

    static public function provideDataForSelectVersion(): array
    {
        return [
            [1, Version::V01],
            [27, Version::V01],
            [28, Version::V02],
            [48, Version::V02],
            [49, Version::V03],
            [77, Version::V03],
            [78, Version::V04],
            [111, Version::V04],
            [112, Version::V05],
            [144, Version::V05],
            [145, Version::V06],
            [178, Version::V06],
            [179, Version::V07],
            [207, Version::V07],
            [208, Version::V08],
            [259, Version::V08],
            [260, Version::V09],
            [312, Version::V09],
            [313, Version::V10],
            [364, Version::V10],
            [365, Version::V11],
            [427, Version::V11],
            [428, Version::V12],
            [489, Version::V12],
            [490, Version::V13],
            [580, Version::V13],
            [581, Version::V14],
            [621, Version::V14],
            [622, Version::V15],
            [703, Version::V15],
            [704, Version::V16],
            [775, Version::V16],
            [776, Version::V17],
            [876, Version::V17],
            [877, Version::V18],
            [948, Version::V18],
            [949, Version::V19],
            [1063, Version::V19],
            [1064, Version::V20],
            [1159, Version::V20],
            [1160, Version::V21],
            [1224, Version::V21],
            [1225, Version::V22],
            [1358, Version::V22],
            [1359, Version::V23],
            [1468, Version::V23],
            [1469, Version::V24],
            [1588, Version::V24],
            [1589, Version::V25],
            [1718, Version::V25],
            [1719, Version::V26],
            [1804, Version::V26],
            [1805, Version::V27],
            [1933, Version::V27],
            [1934, Version::V28],
            [2085, Version::V28],
            [2086, Version::V29],
            [2181, Version::V29],
            [2182, Version::V30],
            [2358, Version::V30],
            [2359, Version::V31],
            [2473, Version::V31],
            [2474, Version::V32],
            [2670, Version::V32],
            [2671, Version::V33],
            [2805, Version::V33],
            [2806, Version::V34],
            [2949, Version::V34],
            [2950, Version::V35],
            [3081, Version::V35],
            [3082, Version::V36],
            [3244, Version::V36],
            [3245, Version::V37],
            [3417, Version::V37],
            [3418, Version::V38],
            [3599, Version::V38],
            [3600, Version::V39],
            [3791, Version::V39],
            [3792, Version::V40],
            [3993, Version::V40],
        ];
    }

    public function testVersionSelectorLimitMax(): void
    {
        $this->expectException(DataTooVoluminous::class);

        $this->selector->selectVersion(3994);
    }
}
