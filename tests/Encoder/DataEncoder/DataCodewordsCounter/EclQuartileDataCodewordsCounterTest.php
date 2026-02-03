<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataEncoder\DataCodewordsCounter;

use Generator;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter\EclQuartileDataCodewordsCounter;
use Guillaumetissier\QrCode\Enums\Version;

class EclQuartileDataCodewordsCounterTest extends DataCodewordsCounterTestCase
{
    protected function setUp(): void
    {
        $this->counter = new EclQuartileDataCodewordsCounter();
    }

    /**
     * @return Generator<array{Version, int}>
     */
    public static function provideDataToTestCount(): Generator
    {
        yield [Version::V01, 13];
        yield [Version::V02, 22];
        yield [Version::V03, 34];
        yield [Version::V04, 48];
        yield [Version::V05, 62];
        yield [Version::V06, 76];
        yield [Version::V07, 88];
        yield [Version::V08, 110];
        yield [Version::V09, 132];
        yield [Version::V10, 154];
        yield [Version::V11, 180];
        yield [Version::V12, 206];
        yield [Version::V13, 244];
        yield [Version::V14, 261];
        yield [Version::V15, 295];
        yield [Version::V16, 325];
        yield [Version::V17, 367];
        yield [Version::V18, 397];
        yield [Version::V19, 445];
        yield [Version::V20, 485];
        yield [Version::V21, 512];
        yield [Version::V22, 568];
        yield [Version::V23, 614];
        yield [Version::V24, 664];
        yield [Version::V25, 718];
        yield [Version::V26, 754];
        yield [Version::V27, 808];
        yield [Version::V28, 871];
        yield [Version::V29, 911];
        yield [Version::V30, 985];
        yield [Version::V31, 1033];
        yield [Version::V32, 1115];
        yield [Version::V33, 1171];
        yield [Version::V34, 1231];
        yield [Version::V35, 1286];
        yield [Version::V36, 1354];
        yield [Version::V37, 1426];
        yield [Version::V38, 1502];
        yield [Version::V39, 1582];
        yield [Version::V40, 1666];
    }
}
