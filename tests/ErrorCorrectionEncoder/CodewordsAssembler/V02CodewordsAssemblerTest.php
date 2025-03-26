<?php

namespace Tests\ErrorCorrectionEncoder\CodewordsAssembler;

use ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler\V02CodewordsAssembler;

class V02CodewordsAssemblerTest extends CodewordsAssemblerTestCase
{
    protected static int $TotalNumberOfCodewords = 44;

    protected static array $TotalNumberOfDataCodewords = [
        'L' => 34,
        'M' => 28,
        'Q' => 22,
        'H' => 16,
    ];

    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 10,
        'M' => 16,
        'Q' => 22,
        'H' => 28,
    ];

    protected static array $AssembledCodewords = [
        'L' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefgh0123456789',
        'M' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZab0123456789012345',
        'Q' => 'ABCDEFGHIJKLMNOPQRSTUV0123456789012345678901',
        'H' => 'ABCDEFGHIJKLMNOP0123456789012345678901234567',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordsAssembler = new V02CodewordsAssembler($this->logger);
    }
}
