<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataAnalyser\Version\Selector;

use Guillaumetissier\QrCode\Tests\Logger\LoggerTestCase;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\AlphanumericLowVersionSelector;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\DataTooVoluminous;

class AlphanumericLowVersionSelectorTest extends LoggerTestCase
{
    private AlphanumericLowVersionSelector $selector;

    public function setUp(): void
    {
        parent::setUp();

        $this->selector = new AlphanumericLowVersionSelector($this->logger);
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
            [25, Version::V01],
            [26, Version::V02],
            [47, Version::V02],
            [48, Version::V03],
            [77, Version::V03],
            [78, Version::V04],
            [114, Version::V04],
            [115, Version::V05],
            [154, Version::V05],
            [155, Version::V06],
            [195, Version::V06],
            [196, Version::V07],
            [224, Version::V07],
            [225, Version::V08],
            [279, Version::V08],
            [280, Version::V09],
            [335, Version::V09],
            [336, Version::V10],
            [395, Version::V10],
            [396, Version::V11],
            [468, Version::V11],
            [469, Version::V12],
            [535, Version::V12],
            [536, Version::V13],
            [619, Version::V13],
            [620, Version::V14],
            [667, Version::V14],
            [668, Version::V15],
            [758, Version::V15],
            [759, Version::V16],
            [854, Version::V16],
            [855, Version::V17],
            [938, Version::V17],
            [939, Version::V18],
            [1046, Version::V18],
            [1047, Version::V19],
            [1153, Version::V19],
            [1154, Version::V20],
            [1249, Version::V20],
            [1250, Version::V21],
            [1352, Version::V21],
            [1353, Version::V22],
            [1460, Version::V22],
            [1461, Version::V23],
            [1588, Version::V23],
            [1589, Version::V24],
            [1704, Version::V24],
            [1705, Version::V25],
            [1853, Version::V25],
            [1854, Version::V26],
            [1990, Version::V26],
            [1991, Version::V27],
            [2132, Version::V27],
            [2133, Version::V28],
            [2223, Version::V28],
            [2224, Version::V29],
            [2369, Version::V29],
            [2370, Version::V30],
            [2520, Version::V30],
            [2521, Version::V31],
            [2677, Version::V31],
            [2678, Version::V32],
            [2840, Version::V32],
            [2841, Version::V33],
            [3009, Version::V33],
            [3010, Version::V34],
            [3183, Version::V34],
            [3184, Version::V35],
            [3351, Version::V35],
            [3352, Version::V36],
            [3537, Version::V36],
            [3538, Version::V37],
            [3729, Version::V37],
            [3730, Version::V38],
            [3927, Version::V38],
            [3928, Version::V39],
            [4087, Version::V39],
            [4088, Version::V40],
            [4296, Version::V40],
        ];
    }

    public function testVersionSelectorLimitMax(): void
    {
        $this->expectException(DataTooVoluminous::class);

        $this->selector->selectVersion(4297);
    }
}
