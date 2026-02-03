<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks\V01CodewordBlocks;

class V01CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 26;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 19,
        'M' => 16,
        'Q' => 13,
        'H' => 9
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 7,
        'M' => 10,
        'Q' => 13,
        'H' => 17
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V01CodewordBlocks();
    }
}
