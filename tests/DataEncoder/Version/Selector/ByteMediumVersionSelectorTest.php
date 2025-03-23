<?php

namespace Tests\DataEncoder\Version\Selector;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\ByteMediumVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Exception\DataTooVoluminous;

class ByteMediumVersionSelectorTest extends LoggerTestCase
{
    private ByteMediumVersionSelector $selector;

    public function setUp(): void
    {
        parent::setUp();

        $this->selector = new ByteMediumVersionSelector($this->logger);
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
            [14, Version::V01],
            [15, Version::V02],
            [26, Version::V02],
            [27, Version::V03],
            [42, Version::V03],
            [43, Version::V04],
            [62, Version::V04],
            [63, Version::V05],
            [84, Version::V05],
            [85, Version::V06],
            [106, Version::V06],
            [107, Version::V07],
            [122, Version::V07],
            [123, Version::V08],
            [152, Version::V08],
            [153, Version::V09],
            [180, Version::V09],
            [181, Version::V10],
            [213, Version::V10],
            [214, Version::V11],
            [251, Version::V11],
            [252, Version::V12],
            [287, Version::V12],
            [288, Version::V13],
            [331, Version::V13],
            [332, Version::V14],
            [362, Version::V14],
            [363, Version::V15],
            [412, Version::V15],
            [413, Version::V16],
            [450, Version::V16],
            [451, Version::V17],
            [504, Version::V17],
            [505, Version::V18],
            [560, Version::V18],
            [561, Version::V19],
            [624, Version::V19],
            [625, Version::V20],
            [666, Version::V20],
            [667, Version::V21],
            [711, Version::V21],
            [712, Version::V22],
            [779, Version::V22],
            [780, Version::V23],
            [857, Version::V23],
            [858, Version::V24],
            [911, Version::V24],
            [912, Version::V25],
            [997, Version::V25],
            [998, Version::V26],
            [1059, Version::V26],
            [1060, Version::V27],
            [1125, Version::V27],
            [1126, Version::V28],
            [1190, Version::V28],
            [1191, Version::V29],
            [1264, Version::V29],
            [1265, Version::V30],
            [1370, Version::V30],
            [1371, Version::V31],
            [1452, Version::V31],
            [1453, Version::V32],
            [1538, Version::V32],
            [1539, Version::V33],
            [1628, Version::V33],
            [1698, Version::V34],
            [1722, Version::V34],
            [1723, Version::V35],
            [1809, Version::V35],
            [1810, Version::V36],
            [1911, Version::V36],
            [1912, Version::V37],
            [1989, Version::V37],
            [1990, Version::V38],
            [2099, Version::V38],
            [2100, Version::V39],
            [2213, Version::V39],
            [2214, Version::V40],
            [2331, Version::V40],
        ];
    }

    public function testVersionSelectorLimitMax(): void
    {
        $this->expectException(DataTooVoluminous::class);

        $this->selector->selectVersion(2332);
    }
}
