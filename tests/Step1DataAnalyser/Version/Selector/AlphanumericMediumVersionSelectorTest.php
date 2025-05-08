<?php

namespace Tests\Step1DataAnalyser\Version\Selector;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Exception\DataTooVoluminous;
use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Selector\AlphanumericMediumVersionSelector;

class AlphanumericMediumVersionSelectorTest extends LoggerTestCase
{
    private AlphanumericMediumVersionSelector $selector;

    public function setUp(): void
    {
        parent::setUp();

        $this->selector = new AlphanumericMediumVersionSelector($this->logger);
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
            [20, Version::V01],
            [21, Version::V02],
            [38, Version::V02],
            [39, Version::V03],
            [61, Version::V03],
            [62, Version::V04],
            [90, Version::V04],
            [91, Version::V05],
            [122, Version::V05],
            [123, Version::V06],
            [154, Version::V06],
            [155, Version::V07],
            [178, Version::V07],
            [179, Version::V08],
            [221, Version::V08],
            [222, Version::V09],
            [262, Version::V09],
            [263, Version::V10],
            [311, Version::V10],
            [312, Version::V11],
            [366, Version::V11],
            [367, Version::V12],
            [419, Version::V12],
            [420, Version::V13],
            [483, Version::V13],
            [484, Version::V14],
            [528, Version::V14],
            [529, Version::V15],
            [600, Version::V15],
            [601, Version::V16],
            [656, Version::V16],
            [657, Version::V17],
            [734, Version::V17],
            [735, Version::V18],
            [816, Version::V18],
            [817, Version::V19],
            [909, Version::V19],
            [910, Version::V20],
            [970, Version::V20],
            [971, Version::V21],
            [1035, Version::V21],
            [1036, Version::V22],
            [1134, Version::V22],
            [1135, Version::V23],
            [1248, Version::V23],
            [1249, Version::V24],
            [1326, Version::V24],
            [1327, Version::V25],
            [1451, Version::V25],
            [1452, Version::V26],
            [1542, Version::V26],
            [1543, Version::V27],
            [1637, Version::V27],
            [1638, Version::V28],
            [1732, Version::V28],
            [1733, Version::V29],
            [1839, Version::V29],
            [1840, Version::V30],
            [1994, Version::V30],
            [1995, Version::V31],
            [2113, Version::V31],
            [2114, Version::V32],
            [2238, Version::V32],
            [2239, Version::V33],
            [2369, Version::V33],
            [2370, Version::V34],
            [2506, Version::V34],
            [2507, Version::V35],
            [2632, Version::V35],
            [2633, Version::V36],
            [2780, Version::V36],
            [2781, Version::V37],
            [2894, Version::V37],
            [2895, Version::V38],
            [3054, Version::V38],
            [3055, Version::V39],
            [3220, Version::V39],
            [3221, Version::V40],
            [3391, Version::V40],
        ];
    }

    public function testVersionSelectorLimitMax(): void
    {
        $this->expectException(DataTooVoluminous::class);

        $this->selector->selectVersion(3392);
    }
}
