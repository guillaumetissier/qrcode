<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 35, table 14
 */
final class V06CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [2, new ErrorCorrectionCodePerBlock(86, 68, 9)],
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [4, new ErrorCorrectionCodePerBlock(43, 27, 8)],
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [4, new ErrorCorrectionCodePerBlock(43, 19, 12)],
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [4, new ErrorCorrectionCodePerBlock(43, 15, 14)],
            ],
        ]);
    }
}
