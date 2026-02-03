<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 35, table 14
 */
final class V03CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [1, new ErrorCorrectionCodePerBlock(70, 55, 7)]
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [1, new ErrorCorrectionCodePerBlock(70, 44, 13)]
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [2, new ErrorCorrectionCodePerBlock(35, 17, 9)]
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [2, new ErrorCorrectionCodePerBlock(35, 13, 11)]
            ],
        ]);
    }
}
