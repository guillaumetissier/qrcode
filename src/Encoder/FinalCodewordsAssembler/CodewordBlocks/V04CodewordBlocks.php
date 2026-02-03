<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 35, table 14
 */
final class V04CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [1, new ErrorCorrectionCodePerBlock(100, 80, 10)]
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [2, new ErrorCorrectionCodePerBlock(50, 32, 9)]
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [2, new ErrorCorrectionCodePerBlock(50, 24, 13)]
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [4, new ErrorCorrectionCodePerBlock(25, 9, 8)]
            ],
        ]);
    }
}
