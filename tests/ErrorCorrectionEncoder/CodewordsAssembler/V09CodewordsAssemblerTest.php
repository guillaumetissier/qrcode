<?php

namespace Tests\ErrorCorrectionEncoder\CodewordsAssembler;

use ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler\V09CodewordsAssembler;

class V09CodewordsAssemblerTest extends CodewordsAssemblerTestCase
{
    protected static int $TotalNumberOfCodewords = 292;

    protected static array $TotalNumberOfDataCodewords = [
        'L' => 232,
        'M' => 182,
        'Q' => 132,
        'H' => 100,
    ];

    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 60,
        'M' => 110,
        'Q' => 160,
        'H' => 192,
    ];

    protected static array $AssembledCodewords = [
        'L' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKL012345678901234567890123456789MNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWX012345678901234567890123456789',
        'M' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghij0123456789012345678901klmnopqrstuvwxyzABCDEFGHIJKLMNOPQRST2345678901234567890123UVWXYZabcdefghijklmnopqrstuvwxyzABCD4567890123456789012345EFGHIJKLMNOPQRSTUVWXYZabcdefghijklmno6789012345678901234567pqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ8901234567890123456789',
        'Q' => 'ABCDEFGHIJKLMNOP01234567890123456789QRSTUVWXYZabcdef01234567890123456789ghijklmnopqrstuv01234567890123456789wxyzABCDEFGHIJKL01234567890123456789MNOPQRSTUVWXYZabc01234567890123456789defghijklmnopqrst01234567890123456789uvwxyzABCDEFGHIJK01234567890123456789LMNOPQRSTUVWXYZab01234567890123456789',
        'H' => 'ABCDEFGHIJKL012345678901234567890123MNOPQRSTUVWX456789012345678901234567YZabcdefghij890123456789012345678901klmnopqrstuv234567890123456789012345wxyzABCDEFGHI678901234567890123456789JKLMNOPQRSTUV012345678901234567890123WXYZabcdefghi456789012345678901234567jklmnopqrstuv890123456789012345678901',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordsAssembler = new V09CodewordsAssembler($this->logger);
    }
}
