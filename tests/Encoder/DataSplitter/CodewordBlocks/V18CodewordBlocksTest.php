<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks\V18CodewordBlocks;

/**
 * ISO/IEC 18004:2000(E) p. 38, table 14
 */
class V18CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 901;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 721,
        'M' => 563,
        'Q' => 397,
        'H' => 313,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 180,
        'M' => 338,
        'Q' => 504,
        'H' => 588,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V18CodewordBlocks();
    }
}
