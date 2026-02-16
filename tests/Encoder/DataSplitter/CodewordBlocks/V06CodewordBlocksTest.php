<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks\V06CodewordBlocks;

class V06CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 172;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 136,
        'M' => 108,
        'Q' => 76,
        'H' => 60,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 36,
        'M' => 64,
        'Q' => 96,
        'H' => 112,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V06CodewordBlocks();
    }
}
