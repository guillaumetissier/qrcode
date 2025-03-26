<?php

namespace Tests\ErrorCorrectionEncoder\CodewordsAssembler;

use ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler\V04CodewordsAssembler;

class V04CodewordsAssemblerTest extends CodewordsAssemblerTestCase
{
    protected static int $TotalNumberOfCodewords = 100;

    protected static array $TotalNumberOfDataCodewords = [
        'L' => 80,
        'M' => 64,
        'Q' => 48,
        'H' => 36,
    ];

    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 20,
        'M' => 36,
        'Q' => 52,
        'H' => 64,
    ];

    protected static array $AssembledCodewords = [
        'L' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZab01234567890123456789',
        'M' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdef012345678901234567ghijklmnopqrstuvwxyzABCDEFGHIJKL890123456789012345',
        'Q' => 'ABCDEFGHIJKLMNOPQRSTUVWX01234567890123456789012345YZabcdefghijklmnopqrstuv67890123456789012345678901',
        'H' => 'ABCDEFGHI0123456789012345JKLMNOPQR6789012345678901STUVWXYZa2345678901234567bcdefghij8901234567890123',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordsAssembler = new V04CodewordsAssembler($this->logger);
    }
}
