<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks\V04CodewordBlocks;

class V04CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 100;

    protected static array $TotalNumberOfDataCodewords = [
        'L' => 80,
        'M' => 64,
        'Q' => 48,
        'H' => 36,
    ];

    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 20,
        'M' => 36,
        'Q' => 52,
        'H' => 64,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V04CodewordBlocks();
    }
}
