<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 38, table 14
 */
final class V18CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [5, new ErrorCorrectionCodePerBlock(150, 120, 15)],
                [1, new ErrorCorrectionCodePerBlock(151, 121, 15)],
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [9, new ErrorCorrectionCodePerBlock(69, 43, 13)],
                [4, new ErrorCorrectionCodePerBlock(70, 44, 13)],
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [17, new ErrorCorrectionCodePerBlock(50, 22, 14)],
                [1, new ErrorCorrectionCodePerBlock(51, 23, 14)],
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [2, new ErrorCorrectionCodePerBlock(42, 14, 14)],
                [19, new ErrorCorrectionCodePerBlock(43, 15, 14)],
            ],
        ]);
    }
}
