<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks\V16CodewordBlocks;

/**
 * ISO/IEC 18004:2000(E) p. 38, table 14
 */
class V16CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 733;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 589,
        'M' => 453,
        'Q' => 325,
        'H' => 253,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 144,
        'M' => 280,
        'Q' => 408,
        'H' => 480,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V16CodewordBlocks();
    }
}
