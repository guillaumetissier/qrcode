<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 36, table 14
 */
final class V08CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [2, new ErrorCorrectionCodePerBlock(121, 97, 12)],
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [2, new ErrorCorrectionCodePerBlock(60, 38, 11)],
                [2, new ErrorCorrectionCodePerBlock(61, 39, 11)],
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [4, new ErrorCorrectionCodePerBlock(40, 18, 9)],
                [2, new ErrorCorrectionCodePerBlock(41, 19, 9)],
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [4, new ErrorCorrectionCodePerBlock(40, 14, 13)],
                [2, new ErrorCorrectionCodePerBlock(41, 15, 13)],
            ],
        ]);
    }
}
