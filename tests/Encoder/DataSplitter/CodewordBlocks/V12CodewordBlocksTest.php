<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks\V12CodewordBlocks;

/**
 * ISO/IEC 18004:2000(E) p. 37, table 14
 */
class V12CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 466;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 370,
        'M' => 290,
        'Q' => 206,
        'H' => 158,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 96,
        'M' => 176,
        'Q' => 260,
        'H' => 308,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V12CodewordBlocks();
    }
}
