<?php

namespace Tests\Step2DataEncodation\DataCodewordsCounter;

use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter\EclHighDataCodewordsCounter;

class EclHighDataCodewordsCounterTest extends DataCodewordsCounterTestCase
{
    protected function setUp(): void
    {
        $this->counter = new EclHighDataCodewordsCounter();
    }

    public static function provideDataToTestCount(): \Generator
    {
        yield [Version::V01, 9];
        yield [Version::V02, 16];
        yield [Version::V03, 26];
        yield [Version::V04, 36];
        yield [Version::V05, 46];
        yield [Version::V06, 60];
        yield [Version::V07, 66];
        yield [Version::V08, 86];
        yield [Version::V09, 100];
        yield [Version::V10, 122];
        yield [Version::V11, 140];
        yield [Version::V12, 158];
        yield [Version::V13, 180];
        yield [Version::V14, 197];
        yield [Version::V15, 223];
        yield [Version::V16, 253];
        yield [Version::V17, 283];
        yield [Version::V18, 313];
        yield [Version::V19, 341];
        yield [Version::V20, 385];
        yield [Version::V21, 406];
        yield [Version::V22, 442];
        yield [Version::V23, 464];
        yield [Version::V24, 514];
        yield [Version::V25, 538];
        yield [Version::V26, 596];
        yield [Version::V27, 628];
        yield [Version::V28, 661];
        yield [Version::V29, 701];
        yield [Version::V30, 745];
        yield [Version::V31, 793];
        yield [Version::V32, 845];
        yield [Version::V33, 901];
        yield [Version::V34, 961];
        yield [Version::V35, 986];
        yield [Version::V36, 1054];
        yield [Version::V37, 1096];
        yield [Version::V38, 1142];
        yield [Version::V39, 1222];
        yield [Version::V40, 1276];
    }
}
