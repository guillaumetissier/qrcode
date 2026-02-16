<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks\V15CodewordBlocks;

/**
 * ISO/IEC 18004:2000(E) p. 38, table 14
 */
class V15CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 655;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 523,
        'M' => 415,
        'Q' => 295,
        'H' => 223,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 132,
        'M' => 240,
        'Q' => 360,
        'H' => 432,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V15CodewordBlocks();
    }
}
