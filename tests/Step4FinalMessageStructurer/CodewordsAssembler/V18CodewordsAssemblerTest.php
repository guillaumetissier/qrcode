<?php

namespace Tests\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler\V18CodewordsAssembler;

/**
 * ISO/IEC 18004:2000(E) p. 38, table 14
 */
class V18CodewordsAssemblerTest extends CodewordsAssemblerTestCase
{
    protected static int $TotalNumberOfCodewords = 901;

    protected static array $TotalNumberOfDataCodewords = [
        'L' => 721,
        'M' => 563,
        'Q' => 397,
        'H' => 313,
    ];

    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 180,
        'M' => 338,
        'Q' => 504,
        'H' => 588,
    ];

    protected static array $AssembledCodewords = [
        'L' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOP012345678901234567890123456789QRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdef012345678901234567890123456789ghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuv012345678901234567890123456789wxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKL012345678901234567890123456789MNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZab012345678901234567890123456789cdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrs012345678901234567890123456789',
        'M' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopq01234567890123456789012345rstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefgh67890123456789012345678901ijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXY23456789012345678901234567ZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOP89012345678901234567890123QRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFG45678901234567890123456789HIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwx01234567890123456789012345yzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmno67890123456789012345678901pqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdef23456789012345678901234567ghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVW89012345678901234567890123XYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNO45678901234567890123456789PQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFG01234567890123456789012345HIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxy67890123456789012345678901zABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopq23456789012345678901234567',
        'Q' => 'ABCDEFGHIJKLMNOPQRSTUV0123456789012345678901234567WXYZabcdefghijklmnopqr8901234567890123456789012345stuvwxyzABCDEFGHIJKLMN6789012345678901234567890123OPQRSTUVWXYZabcdefghij4567890123456789012345678901klmnopqrstuvwxyzABCDEF2345678901234567890123456789GHIJKLMNOPQRSTUVWXYZab0123456789012345678901234567cdefghijklmnopqrstuvwx8901234567890123456789012345yzABCDEFGHIJKLMNOPQRST6789012345678901234567890123UVWXYZabcdefghijklmnop4567890123456789012345678901qrstuvwxyzABCDEFGHIJKL2345678901234567890123456789MNOPQRSTUVWXYZabcdefgh0123456789012345678901234567ijklmnopqrstuvwxyzABCD8901234567890123456789012345EFGHIJKLMNOPQRSTUVWXYZ6789012345678901234567890123abcdefghijklmnopqrstuv4567890123456789012345678901wxyzABCDEFGHIJKLMNOPQR2345678901234567890123456789STUVWXYZabcdefghijklmn0123456789012345678901234567opqrstuvwxyzABCDEFGHIJ8901234567890123456789012345KLMNOPQRSTUVWXYZabcdefg6789012345678901234567890123',
        'H' => 'ABCDEFGHIJKLMN0123456789012345678901234567OPQRSTUVWXYZab8901234567890123456789012345cdefghijklmnopq6789012345678901234567890123rstuvwxyzABCDEF4567890123456789012345678901GHIJKLMNOPQRSTU2345678901234567890123456789VWXYZabcdefghij0123456789012345678901234567klmnopqrstuvwxy8901234567890123456789012345zABCDEFGHIJKLMN6789012345678901234567890123OPQRSTUVWXYZabc4567890123456789012345678901defghijklmnopqr2345678901234567890123456789stuvwxyzABCDEFG0123456789012345678901234567HIJKLMNOPQRSTUV8901234567890123456789012345WXYZabcdefghijk6789012345678901234567890123lmnopqrstuvwxyz4567890123456789012345678901ABCDEFGHIJKLMNO2345678901234567890123456789PQRSTUVWXYZabcd0123456789012345678901234567efghijklmnopqrs8901234567890123456789012345tuvwxyzABCDEFGH6789012345678901234567890123IJKLMNOPQRSTUVW4567890123456789012345678901XYZabcdefghijkl2345678901234567890123456789mnopqrstuvwxyzA0123456789012345678901234567',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordsAssembler = new V18CodewordsAssembler($this->logger);
    }
}
