<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks\V14CodewordBlocks;

/**
 * ISO/IEC 18004:2000(E) p. 37, table 14
 */
class V14CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 581;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 461,
        'M' => 365,
        'Q' => 261,
        'H' => 197,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 120,
        'M' => 216,
        'Q' => 320,
        'H' => 384,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V14CodewordBlocks();
    }
}
