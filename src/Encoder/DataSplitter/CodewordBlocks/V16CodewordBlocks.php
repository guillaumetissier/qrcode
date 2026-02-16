<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 38, table 14
 */
final class V16CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [5, new ErrorCorrectionCodePerBlock(122, 98, 12)],
                [1, new ErrorCorrectionCodePerBlock(123, 99, 12)],
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [7, new ErrorCorrectionCodePerBlock(73, 45, 14)],
                [3, new ErrorCorrectionCodePerBlock(74, 46, 14)],
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [15, new ErrorCorrectionCodePerBlock(43, 19, 12)],
                [2, new ErrorCorrectionCodePerBlock(44, 20, 12)],
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [3, new ErrorCorrectionCodePerBlock(45, 15, 15)],
                [13, new ErrorCorrectionCodePerBlock(46, 16, 15)],
            ],
        ]);
    }
}
