<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks\V13CodewordBlocks;

/**
 * ISO/IEC 18004:2000(E) p. 37, table 14
 */
class V13CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 532;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 428,
        'M' => 334,
        'Q' => 244,
        'H' => 180,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 104,
        'M' => 198,
        'Q' => 288,
        'H' => 352,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V13CodewordBlocks();
    }
}
