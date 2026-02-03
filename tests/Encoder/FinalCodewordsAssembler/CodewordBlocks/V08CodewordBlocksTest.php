<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks\V08CodewordBlocks;

class V08CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 242;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 194,
        'M' => 154,
        'Q' => 110,
        'H' => 86,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 48,
        'M' => 88,
        'Q' => 132,
        'H' => 156,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V08CodewordBlocks();
    }
}
