<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 35, table 14
 */
final class V05CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [1, new ErrorCorrectionCodePerBlock(134, 108, 13)]
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [2, new ErrorCorrectionCodePerBlock(67, 43, 12)]
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [2, new ErrorCorrectionCodePerBlock(33, 15, 9)],
                [2, new ErrorCorrectionCodePerBlock(34, 16, 9)]
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [2, new ErrorCorrectionCodePerBlock(33, 11, 11)],
                [2, new ErrorCorrectionCodePerBlock(34, 12, 11)]
            ],
        ]);
    }
}
