<?php

namespace Tests\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler\V05CodewordsAssembler;

class V05CodewordsAssemblerTest extends CodewordsAssemblerTestCase
{
    protected static int $TotalNumberOfCodewords = 134;

    protected static array $TotalNumberOfDataCodewords = [
        'L' => 108,
        'M' => 86,
        'Q' => 62,
        'H' => 46,
    ];

    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 26,
        'M' => 48,
        'Q' => 72,
        'H' => 88,
    ];

    protected static array $AssembledCodewords = [
        'L' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNO' .
            'PQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCD01234567890123456789012345',
        'M' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopq012345678901234567890123' .
            'rstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefgh456789012345678901234567',
        'Q' => 'ABCDEFGHIJKLMNO012345678901234567PQRSTUVWXYZabcd890123456789012345e' .
            'fghijklmnopqrst678901234567890123uvwxyzABCDEFGHIJ456789012345678901',
        'H' => 'ABCDEFGHIJK0123456789012345678901LMNOPQRSTUV2345678901234567890123W' .
            'XYZabcdefgh4567890123456789012345ijklmnopqrst6789012345678901234567',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordsAssembler = new V05CodewordsAssembler($this->logger);
    }
}
