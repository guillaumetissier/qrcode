<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks\V09CodewordBlocks;

class V09CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 292;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 232,
        'M' => 182,
        'Q' => 132,
        'H' => 100,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 60,
        'M' => 110,
        'Q' => 160,
        'H' => 192,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V09CodewordBlocks();
    }
}
