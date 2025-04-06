<?php

namespace Tests\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler\V06CodewordsAssembler;

class V06CodewordsAssemblerTest extends CodewordsAssemblerTestCase
{
    protected static int $TotalNumberOfCodewords = 172;

    protected static array $TotalNumberOfDataCodewords = [
        'L' => 136,
        'M' => 108,
        'Q' => 76,
        'H' => 60,
    ];

    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 36,
        'M' => 64,
        'Q' => 96,
        'H' => 112,
    ];

    protected static array $AssembledCodewords = [
        'L' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOP012345678901234567QRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdef890123456789012345',
        'M' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZa0123456789012345bcdefghijklmnopqrstuvwxyzAB6789012345678901CDEFGHIJKLMNOPQRSTUVWXYZabc2345678901234567defghijklmnopqrstuvwxyzABCD8901234567890123',
        'Q' => 'ABCDEFGHIJKLMNOPQRS012345678901234567890123TUVWXYZabcdefghijkl456789012345678901234567mnopqrstuvwxyzABCDE890123456789012345678901FGHIJKLMNOPQRSTUVWX234567890123456789012345',
        'H' => 'ABCDEFGHIJKLMNO0123456789012345678901234567PQRSTUVWXYZabcd8901234567890123456789012345efghijklmnopqrs6789012345678901234567890123tuvwxyzABCDEFGH4567890123456789012345678901',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordsAssembler = new V06CodewordsAssembler($this->logger);
    }
}
