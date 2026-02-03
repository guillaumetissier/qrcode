<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 36, table 14
 */
final class V10CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [2, new ErrorCorrectionCodePerBlock(86, 68, 9)],
                [2, new ErrorCorrectionCodePerBlock(87, 69, 9)],
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [4, new ErrorCorrectionCodePerBlock(69, 43, 13)],
                [1, new ErrorCorrectionCodePerBlock(70, 44, 13)],
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [6, new ErrorCorrectionCodePerBlock(43, 19, 12)],
                [2, new ErrorCorrectionCodePerBlock(44, 20, 12)],
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [6, new ErrorCorrectionCodePerBlock(43, 15, 14)],
                [2, new ErrorCorrectionCodePerBlock(44, 16, 14)],
            ],
        ]);
    }
}
