<?php

namespace Tests\DataEncoder\Version;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Version\NumericQuartileVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class NumericQuartileVersionSelectorTest extends TestCase
{
    private NumericQuartileVersionSelector $selector;

    public function setUp(): void
    {
        $this->selector = new NumericQuartileVersionSelector();
    }

    /**
     * @throws \Exception
     * @dataProvider provideDataToTestVersionSelector
     */
    public function testVersionSelector(int $dataLength, int $expectedVersion): void
    {
        $this->assertEquals(
            Version::fromInt($expectedVersion),
            $this->selector->selectVersion($dataLength)
        );
    }

    static public function provideDataToTestVersionSelector(): array
    {
        return [
            [27, 1],
            [47, 2],
            [77, 3],
            [106, 4],
            [139, 5],
            [182, 6],
            [226, 7],
            [284, 8],
            [364, 9],
            [427, 10],
            [511, 11],
            [602, 12],
            [674, 13],
            [745, 14],
            [913, 15],
            [1064, 16],
            [1228, 17],
            [1408, 18],
            [1588, 19],
            [1759, 20],
            [1911, 21],
            [2114, 22],
            [2350, 23],
            [2525, 24],
            [2700, 25],
            [2935, 26],
            [3180, 27],
            [3400, 28],
            [3675, 29],
            [3943, 30],
            [4230, 31],
            [4535, 32],
            [4853, 33],
            [5182, 34],
            [5512, 35],
            [5864, 36],
            [6227, 37],
            [6595, 38],
            [6961, 39],
            [7344, 40],
        ];
    }
}
