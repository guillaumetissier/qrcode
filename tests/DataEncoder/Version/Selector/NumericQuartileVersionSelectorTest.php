<?php

namespace Tests\DataEncoder\Version\Selector;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\NumericQuartileVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\DataEncoder\Version\VersionFromIntConverter;

class NumericQuartileVersionSelectorTest extends TestCase
{
    private NumericQuartileVersionSelector $selector;

    public function setUp(): void
    {
        $this->selector = new NumericQuartileVersionSelector(new VersionFromIntConverter());
    }

    /**
     * @throws \Exception
     * @dataProvider provideDataToTestVersionSelector
     */
    public function testVersionSelector(int $dataLength, Version $expectedVersion): void
    {
        $this->assertEquals($expectedVersion, $this->selector->selectVersion($dataLength));
    }

    static public function provideDataToTestVersionSelector(): array
    {
        return [
            [27, Version::V01],
            [47, Version::V02],
            [77, Version::V03],
            [106, Version::V04],
            [139, Version::V05],
            [182, Version::V06],
            [226, Version::V07],
            [284, Version::V08],
            [364, Version::V09],
            [427, Version::V10],
            [511, Version::V11],
            [602, Version::V12],
            [674, Version::V13],
            [745, Version::V14],
            [913, Version::V15],
            [1064, Version::V16],
            [1228, Version::V17],
            [1408, Version::V18],
            [1588, Version::V19],
            [1759, Version::V20],
            [1911, Version::V21],
            [2114, Version::V22],
            [2350, Version::V23],
            [2525, Version::V24],
            [2700, Version::V25],
            [2935, Version::V26],
            [3180, Version::V27],
            [3400, Version::V28],
            [3675, Version::V29],
            [3943, Version::V30],
            [4230, Version::V31],
            [4535, Version::V32],
            [4853, Version::V33],
            [5182, Version::V34],
            [5512, Version::V35],
            [5864, Version::V36],
            [6227, Version::V37],
            [6595, Version::V38],
            [6961, Version::V39],
            [7344, Version::V40],
        ];
    }
}
