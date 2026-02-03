<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks\V17CodewordBlocks;

/**
 * ISO/IEC 18004:2000(E) p. 38, table 14
 */
class V17CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 815;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 647,
        'M' => 507,
        'Q' => 367,
        'H' => 283,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 168,
        'M' => 308,
        'Q' => 448,
        'H' => 532,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V17CodewordBlocks();
    }
}
