<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks\V22CodewordBlocks;

/**
 * ISO/IEC 18004:2000(E) p. 39, table 14
 */
class V22CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 1258;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 1006,
        'M' => 782,
        'Q' => 568,
        'H' => 442,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 252,
        'M' => 476,
        'Q' => 690,
        'H' => 816,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V22CodewordBlocks();
    }
}
