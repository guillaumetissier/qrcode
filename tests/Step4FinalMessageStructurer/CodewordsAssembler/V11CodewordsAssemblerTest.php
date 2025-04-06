<?php

namespace Tests\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler\V11CodewordsAssembler;

/**
 * ISO/IEC 18004:2000(E) p. 37, table 14
 */
class V11CodewordsAssemblerTest extends CodewordsAssemblerTestCase
{
    protected static int $TotalNumberOfCodewords = 404;

    protected static array $TotalNumberOfDataCodewords = [
        'L' => 324,
        'M' => 254,
        'Q' => 180,
        'H' => 140,
    ];

    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 80,
        'M' => 150,
        'Q' => 224,
        'H' => 264,
    ];

    protected static array $AssembledCodewords = [
        'L' =>
            'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabc0123456789012345678'.
            '9defghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEF012345678901234567'.
            '89GHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghi01234567890123456'.
            '789jklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKL01234567890123456789',
        'M' =>
            'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwx012345678901234567890123456789yzABCDEFGHIJKLMNOPQR' .
            'STUVWXYZabcdefghijklmnopqrstuvw012345678901234567890123456789xyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghij' .
            'klmnopqrstuv012345678901234567890123456789wxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstu0123456' .
            '78901234567890123456789vwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrst012345678901234567890123456789',
        'Q' =>
            'ABCDEFGHIJKLMNOPQRSTUV0123456789012345678901234567WXYZabcdefghijklmnopqr8901234567890123456789012345' .
            'stuvwxyzABCDEFGHIJKLMN6789012345678901234567890123OPQRSTUVWXYZabcdefghij4567890123456789012345678901' .
            'klmnopqrstuvwxyzABCDEFG2345678901234567890123456789HIJKLMNOPQRSTUVWXYZabcd01234567890123456789012345' .
            '67efghijklmnopqrstuvwxyzA8901234567890123456789012345BCDEFGHIJKLMNOPQRSTUVWX6789012345678901234567890123',
        'H' =>
            'ABCDEFGHIJKL012345678901234567890123MNOPQRSTUVWX456789012345678901234567YZabcdefghij8901234567890123' .
            '45678901klmnopqrstuvw234567890123456789012345xyzABCDEFGHIJ678901234567890123456789KLMNOPQRSTUVW01234' .
            '5678901234567890123XYZabcdefghij456789012345678901234567klmnopqrstuvw890123456789012345678901xyzABCD' .
            'EFGHIJ234567890123456789012345KLMNOPQRSTUVW678901234567890123456789XYZabcdefghij012345678901234567890123',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordsAssembler = new V11CodewordsAssembler($this->logger);
    }
}
