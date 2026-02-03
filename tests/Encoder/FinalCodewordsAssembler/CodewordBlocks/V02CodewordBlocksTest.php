<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks\V02CodewordBlocks;

class V02CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 44;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 34,
        'M' => 28,
        'Q' => 22,
        'H' => 16,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 10,
        'M' => 16,
        'Q' => 22,
        'H' => 28,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V02CodewordBlocks();
    }
}
