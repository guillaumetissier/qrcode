<?php

namespace Tests\Step2DataEncodation\DataCodewordsCounter;

use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter\EclMediumDataCodewordsCounter;

class EclMediumDataCodewordsCounterTest extends DataCodewordsCounterTestCase
{
    protected function setUp(): void
    {
        $this->counter = new EclMediumDataCodewordsCounter();
    }

    public static function provideDataToTestCount(): \Generator
    {
        yield [Version::V01, 16];
        yield [Version::V02, 28];
        yield [Version::V03, 44];
        yield [Version::V04, 64];
        yield [Version::V05, 86];
        yield [Version::V06, 108];
        yield [Version::V07, 124];
        yield [Version::V08, 154];
        yield [Version::V09, 182];
        yield [Version::V10, 216];
        yield [Version::V11, 254];
        yield [Version::V12, 290];
        yield [Version::V13, 334];
        yield [Version::V14, 365];
        yield [Version::V15, 415];
        yield [Version::V16, 453];
        yield [Version::V17, 507];
        yield [Version::V18, 563];
        yield [Version::V19, 627];
        yield [Version::V20, 669];
        yield [Version::V21, 714];
        yield [Version::V22, 782];
        yield [Version::V23, 860];
        yield [Version::V24, 914];
        yield [Version::V25, 1000];
        yield [Version::V26, 1062];
        yield [Version::V27, 1128];
        yield [Version::V28, 1193];
        yield [Version::V29, 1267];
        yield [Version::V30, 1373];
        yield [Version::V31, 1455];
        yield [Version::V32, 1541];
        yield [Version::V33, 1631];
        yield [Version::V34, 1725];
        yield [Version::V35, 1812];
        yield [Version::V36, 1914];
        yield [Version::V37, 1992];
        yield [Version::V38, 2102];
        yield [Version::V39, 2216];
        yield [Version::V40, 2334];
    }
}
