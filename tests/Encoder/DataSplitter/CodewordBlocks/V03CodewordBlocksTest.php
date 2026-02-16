<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks\V03CodewordBlocks;

class V03CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 70;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 55,
        'M' => 44,
        'Q' => 34,
        'H' => 26,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 15,
        'M' => 26,
        'Q' => 36,
        'H' => 44,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V03CodewordBlocks();
    }
}
