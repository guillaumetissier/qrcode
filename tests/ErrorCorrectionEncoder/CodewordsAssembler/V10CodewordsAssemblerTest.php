<?php

namespace Tests\ErrorCorrectionEncoder\CodewordsAssembler;

use ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler\V10CodewordsAssembler;

class V10CodewordsAssemblerTest extends CodewordsAssemblerTestCase
{
    protected static int $TotalNumberOfCodewords = 346;

    protected static array $TotalNumberOfDataCodewords = [
        'L' => 274,
        'M' => 216,
        'Q' => 154,
        'H' => 122,
    ];

    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 72,
        'M' => 130,
        'Q' => 192,
        'H' => 224,
    ];

    protected static array $AssembledCodewords = [
        'L' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOP012345678901234567QRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdef890123456789012345ghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvw678901234567890123xyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN456789012345678901',
        'M' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopq01234567890123456789012345rstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefgh67890123456789012345678901ijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXY23456789012345678901234567ZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOP89012345678901234567890123QRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGH45678901234567890123456789',
        'Q' => 'ABCDEFGHIJKLMNOPQRS012345678901234567890123TUVWXYZabcdefghijkl456789012345678901234567mnopqrstuvwxyzABCDE890123456789012345678901FGHIJKLMNOPQRSTUVWX234567890123456789012345YZabcdefghijklmnopq678901234567890123456789rstuvwxyzABCDEFGHIJ012345678901234567890123KLMNOPQRSTUVWXYZabcd456789012345678901234567efghijklmnopqrstuvwx890123456789012345678901',
        'H' => 'ABCDEFGHIJKLMNO0123456789012345678901234567PQRSTUVWXYZabcd8901234567890123456789012345efghijklmnopqrs6789012345678901234567890123tuvwxyzABCDEFGH4567890123456789012345678901IJKLMNOPQRSTUVW2345678901234567890123456789XYZabcdefghijkl0123456789012345678901234567mnopqrstuvwxyzAB8901234567890123456789012345CDEFGHIJKLMNOPQR6789012345678901234567890123',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordsAssembler = new V10CodewordsAssembler($this->logger);
    }
}
