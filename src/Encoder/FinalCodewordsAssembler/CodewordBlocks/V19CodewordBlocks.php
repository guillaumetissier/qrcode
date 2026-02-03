<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 39, table 14
 */
final class V19CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [3, new ErrorCorrectionCodePerBlock(141, 113, 14)],
                [4, new ErrorCorrectionCodePerBlock(142, 114, 14)],
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [3, new ErrorCorrectionCodePerBlock(70, 44, 13)],
                [11, new ErrorCorrectionCodePerBlock(71, 45, 13)],
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [17, new ErrorCorrectionCodePerBlock(47, 21, 13)],
                [4, new ErrorCorrectionCodePerBlock(48, 22, 13)],
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [9, new ErrorCorrectionCodePerBlock(39, 13, 13)],
                [16, new ErrorCorrectionCodePerBlock(40, 14, 13)],
            ],
        ]);
    }
}
