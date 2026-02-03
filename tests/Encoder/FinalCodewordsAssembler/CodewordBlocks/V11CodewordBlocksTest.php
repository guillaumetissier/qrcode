<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks\V11CodewordBlocks;

/**
 * ISO/IEC 18004:2000(E) p. 37, table 14
 */
class V11CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 404;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 324,
        'M' => 254,
        'Q' => 180,
        'H' => 140,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 80,
        'M' => 150,
        'Q' => 224,
        'H' => 264,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V11CodewordBlocks();
    }
}
