<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks\V21CodewordBlocks;

/**
 * ISO/IEC 18004:2000(E) p. 39, table 14
 */
class V21CodewordBlocksTest extends CodewordBlocksTestCase
{
    protected static int $TotalNumberOfCodewords = 1156;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [
        'L' => 932,
        'M' => 714,
        'Q' => 512,
        'H' => 406,
    ];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [
        'L' => 224,
        'M' => 442,
        'Q' => 644,
        'H' => 750,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocks = new V21CodewordBlocks();
    }
}
