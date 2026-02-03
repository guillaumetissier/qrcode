<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks\V19CodewordBlocks;

/**
 * ISO/IEC 18004:2000(E) p. 39, table 14
 */
class V19CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 991;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 795,
        'M' => 627,
        'Q' => 445,
        'H' => 341,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 196,
        'M' => 364,
        'Q' => 546,
        'H' => 650,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V19CodewordBlocks();
    }
}
