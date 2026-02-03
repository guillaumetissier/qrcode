<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks\V05CodewordBlocks;

class V05CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 134;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 108,
        'M' => 86,
        'Q' => 62,
        'H' => 46,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 26,
        'M' => 48,
        'Q' => 72,
        'H' => 88,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V05CodewordBlocks();
    }
}
