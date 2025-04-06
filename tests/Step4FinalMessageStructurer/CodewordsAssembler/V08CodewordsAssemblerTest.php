<?php

namespace Tests\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler\V08CodewordsAssembler;

class V08CodewordsAssemblerTest extends CodewordsAssemblerTestCase
{
    protected static int $TotalNumberOfCodewords = 242;

    protected static array $TotalNumberOfDataCodewords = [
        'L' => 194,
        'M' => 154,
        'Q' => 110,
        'H' => 86,
    ];

    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 48,
        'M' => 88,
        'Q' => 132,
        'H' => 156,
    ];

    protected static array $AssembledCodewords = [
        'L' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrs012345678901234567890123tuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkl456789012345678901234567',
        'M' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkl0123456789012345678901mnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWX2345678901234567890123YZabcdefghijklmnopqrstuvwxyzABCDEFGHIJK4567890123456789012345LMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwx6789012345678901234567',
        'Q' => 'ABCDEFGHIJKLMNOPQR0123456789012345678901STUVWXYZabcdefghij2345678901234567890123klmnopqrstuvwxyzAB4567890123456789012345CDEFGHIJKLMNOPQRST6789012345678901234567UVWXYZabcdefghijklm8901234567890123456789nopqrstuvwxyzABCDEF0123456789012345678901',
        'H' => 'ABCDEFGHIJKLMN01234567890123456789012345OPQRSTUVWXYZab67890123456789012345678901cdefghijklmnop23456789012345678901234567qrstuvwxyzABCD89012345678901234567890123EFGHIJKLMNOPQRS45678901234567890123456789TUVWXYZabcdefgh01234567890123456789012345',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordsAssembler = new V08CodewordsAssembler($this->logger);
    }
}
