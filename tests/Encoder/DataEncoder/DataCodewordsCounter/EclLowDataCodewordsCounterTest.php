<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataEncoder\DataCodewordsCounter;

use Generator;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter\EclLowDataCodewordsCounter;
use Guillaumetissier\QrCode\Enums\Version;

class EclLowDataCodewordsCounterTest extends DataCodewordsCounterTestCase
{
    protected function setUp(): void
    {
        $this->counter = new EclLowDataCodewordsCounter();
    }

    /**
     * @return Generator<array{Version, int}>
     */
    public static function provideDataToTestCount(): Generator
    {
        yield [Version::V01, 19];
        yield [Version::V02, 34];
        yield [Version::V03, 55];
        yield [Version::V04, 80];
        yield [Version::V05, 108];
        yield [Version::V06, 136];
        yield [Version::V07, 156];
        yield [Version::V08, 194];
        yield [Version::V09, 232];
        yield [Version::V10, 274];
        yield [Version::V11, 324];
        yield [Version::V12, 370];
        yield [Version::V13, 428];
        yield [Version::V14, 461];
        yield [Version::V15, 523];
        yield [Version::V16, 589];
        yield [Version::V17, 647];
        yield [Version::V18, 721];
        yield [Version::V19, 795];
        yield [Version::V20, 861];
        yield [Version::V21, 932];
        yield [Version::V22, 1006];
        yield [Version::V23, 1094];
        yield [Version::V24, 1174];
        yield [Version::V25, 1276];
        yield [Version::V26, 1370];
        yield [Version::V27, 1468];
        yield [Version::V28, 1531];
        yield [Version::V29, 1631];
        yield [Version::V30, 1735];
        yield [Version::V31, 1843];
        yield [Version::V32, 1955];
        yield [Version::V33, 2071];
        yield [Version::V34, 2191];
        yield [Version::V35, 2306];
        yield [Version::V36, 2434];
        yield [Version::V37, 2566];
        yield [Version::V38, 2702];
        yield [Version::V39, 2812];
        yield [Version::V40, 2956];
    }
}
