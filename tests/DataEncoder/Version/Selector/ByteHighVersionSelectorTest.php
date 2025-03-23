<?php

namespace Tests\DataEncoder\Version\Selector;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\ByteHighVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Exception\DataTooVoluminous;

class ByteHighVersionSelectorTest extends LoggerTestCase
{
    private ByteHighVersionSelector $selector;

    public function setUp(): void
    {
        parent::setUp();

        $this->selector = new ByteHighVersionSelector($this->logger);
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
            [7, Version::V01],
            [8, Version::V02],
            [14, Version::V02],
            [15, Version::V03],
            [24, Version::V03],
            [25, Version::V04],
            [34, Version::V04],
            [35, Version::V05],
            [44, Version::V05],
            [45, Version::V06],
            [58, Version::V06],
            [59, Version::V07],
            [64, Version::V07],
            [65, Version::V08],
            [84, Version::V08],
            [85, Version::V09],
            [98, Version::V09],
            [99, Version::V10],
            [119, Version::V10],
            [120, Version::V11],
            [137, Version::V11],
            [138, Version::V12],
            [155, Version::V12],
            [156, Version::V13],
            [177, Version::V13],
            [178, Version::V14],
            [194, Version::V14],
            [195, Version::V15],
            [220, Version::V15],
            [221, Version::V16],
            [250, Version::V16],
            [251, Version::V17],
            [280, Version::V17],
            [281, Version::V18],
            [310, Version::V18],
            [311, Version::V19],
            [338, Version::V19],
            [339, Version::V20],
            [382, Version::V20],
            [383, Version::V21],
            [403, Version::V21],
            [404, Version::V22],
            [439, Version::V22],
            [440, Version::V23],
            [461, Version::V23],
            [462, Version::V24],
            [511, Version::V24],
            [512, Version::V25],
            [535, Version::V25],
            [536, Version::V26],
            [593, Version::V26],
            [594, Version::V27],
            [625, Version::V27],
            [626, Version::V28],
            [658, Version::V28],
            [659, Version::V29],
            [698, Version::V29],
            [699, Version::V30],
            [742, Version::V30],
            [743, Version::V31],
            [790, Version::V31],
            [791, Version::V32],
            [842, Version::V32],
            [843, Version::V33],
            [898, Version::V33],
            [899, Version::V34],
            [958, Version::V34],
            [959, Version::V35],
            [983, Version::V35],
            [984, Version::V36],
            [1051, Version::V36],
            [1052, Version::V37],
            [1093, Version::V37],
            [1094, Version::V38],
            [1139, Version::V38],
            [1140, Version::V39],
            [1219, Version::V39],
            [1220, Version::V40],
            [1273, Version::V40],
        ];
    }

    public function testVersionSelectorLimitMax(): void
    {
        $this->expectException(DataTooVoluminous::class);

        $this->selector->selectVersion(1274);
    }
}
