<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks\V10CodewordBlocks;

class V10CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 346;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 274,
        'M' => 216,
        'Q' => 154,
        'H' => 122,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 72,
        'M' => 130,
        'Q' => 192,
        'H' => 224,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V10CodewordBlocks();
    }
}
