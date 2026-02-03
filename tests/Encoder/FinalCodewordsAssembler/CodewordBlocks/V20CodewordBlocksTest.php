<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks\V20CodewordBlocks;

/**
 * ISO/IEC 18004:2000(E) p. 39, table 14
 */
class V20CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 1085;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 861,
        'M' => 669,
        'Q' => 485,
        'H' => 385,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 224,
        'M' => 416,
        'Q' => 600,
        'H' => 700,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V20CodewordBlocks();
    }
}
