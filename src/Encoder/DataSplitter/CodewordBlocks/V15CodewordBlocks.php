<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 38, table 14
 */
final class V15CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [5, new ErrorCorrectionCodePerBlock(109, 87, 11)],
                [1, new ErrorCorrectionCodePerBlock(110, 88, 11)],
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [5, new ErrorCorrectionCodePerBlock(65, 41, 12)],
                [5, new ErrorCorrectionCodePerBlock(66, 42, 12)],
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [5, new ErrorCorrectionCodePerBlock(54, 24, 15)],
                [7, new ErrorCorrectionCodePerBlock(55, 25, 15)],
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [11, new ErrorCorrectionCodePerBlock(36, 12, 12)],
                [7, new ErrorCorrectionCodePerBlock(37, 13, 12)],
            ],
        ]);
    }
}
