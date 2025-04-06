<?php

namespace Tests\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler\V07CodewordsAssembler;

class V07CodewordsAssemblerTest extends CodewordsAssemblerTestCase
{
    protected static int $TotalNumberOfCodewords = 196;

    protected static array $TotalNumberOfDataCodewords = [
        'L' => 156,
        'M' => 124,
        'Q' => 88,
        'H' => 66,
    ];

    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 40,
        'M' => 72,
        'Q' => 108,
        'H' => 130,
    ];

    protected static array $AssembledCodewords = [
        'L' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz01234567890123456789',
        'M' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcde012345678901234567fghijklmnopqrstuvwxyzABCDEFGHIJ890123456789012345KLMNOPQRSTUVWXYZabcdefghijklmno678901234567890123pqrstuvwxyzABCDEFGHIJKLMNOPQRST456789012345678901',
        'Q' => 'ABCDEFGHIJKLMN012345678901234567OPQRSTUVWXYZab890123456789012345cdefghijklmnopq678901234567890123rstuvwxyzABCDEF456789012345678901GHIJKLMNOPQRSTU234567890123456789VWXYZabcdefghij012345678901234567',
        'H' => 'ABCDEFGHIJKLM01234567890123456789012345NOPQRSTUVWXYZ67890123456789012345678901abcdefghijklm23456789012345678901234567nopqrstuvwxyz89012345678901234567890123ABCDEFGHIJKLMN45678901234567890123456789',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordsAssembler = new V07CodewordsAssembler($this->logger);
    }
}
