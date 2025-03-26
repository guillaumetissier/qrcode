<?php

namespace Tests\ErrorCorrectionEncoder\CodewordsAssembler;

use ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler\V03CodewordsAssembler;

class V03CodewordsAssemblerTest extends CodewordsAssemblerTestCase
{
    protected static int $TotalNumberOfCodewords = 70;

    protected static array $TotalNumberOfDataCodewords = [
        'L' => 55,
        'M' => 44,
        'Q' => 34,
        'H' => 26,
    ];

    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 15,
        'M' => 26,
        'Q' => 36,
        'H' => 44,
    ];

    protected static array $AssembledCodewords = [
        'L' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABC012345678901234',
        'M' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqr01234567890123456789012345',
        'Q' => 'ABCDEFGHIJKLMNOPQ012345678901234567RSTUVWXYZabcdefgh890123456789012345',
        'H' => 'ABCDEFGHIJKLM0123456789012345678901NOPQRSTUVWXYZ2345678901234567890123',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordsAssembler = new V03CodewordsAssembler($this->logger);
    }
}
