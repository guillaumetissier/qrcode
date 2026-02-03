<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 37, table 14
 */
final class V11CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [4, new ErrorCorrectionCodePerBlock(101, 81, 10)],
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [1, new ErrorCorrectionCodePerBlock(80, 50, 15)],
                [4, new ErrorCorrectionCodePerBlock(81, 51, 15)],
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [4, new ErrorCorrectionCodePerBlock(50, 22, 14)],
                [4, new ErrorCorrectionCodePerBlock(51, 23, 14)],
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [3, new ErrorCorrectionCodePerBlock(36, 12, 12)],
                [8, new ErrorCorrectionCodePerBlock(37, 13, 12)],
            ],
        ]);
    }
}
