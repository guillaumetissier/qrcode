<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks\V07CodewordBlocks;

class V07CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 196;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 156,
        'M' => 124,
        'Q' => 88,
        'H' => 66,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 40,
        'M' => 72,
        'Q' => 108,
        'H' => 130,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V07CodewordBlocks();
    }
}
