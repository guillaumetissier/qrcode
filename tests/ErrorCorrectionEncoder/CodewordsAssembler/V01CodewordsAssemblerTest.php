<?php

namespace Tests\ErrorCorrectionEncoder\CodewordsAssembler;

use ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler\V01CodewordsAssembler;

class V01CodewordsAssemblerTest extends CodewordsAssemblerTestCase
{
    protected static int $TotalNumberOfCodewords = 26;

    protected static array $TotalNumberOfDataCodewords = [
        'L' => 19,
        'M' => 16,
        'Q' => 13,
        'H' => 9
    ];

    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 7,
        'M' => 10,
        'Q' => 13,
        'H' => 17
    ];

    protected static array $AssembledCodewords = [
        'L' => 'ABCDEFGHIJKLMNOPQRS0123456',
        'M' => 'ABCDEFGHIJKLMNOP0123456789',
        'Q' => 'ABCDEFGHIJKLM0123456789012',
        'H' => 'ABCDEFGHI01234567890123456',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordsAssembler = new V01CodewordsAssembler($this->logger);
    }
}
