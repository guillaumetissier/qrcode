<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 39, table 14
 */
final class V22CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [2, new ErrorCorrectionCodePerBlock(139, 111, 14)],
                [7, new ErrorCorrectionCodePerBlock(140, 112, 14)],
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [17, new ErrorCorrectionCodePerBlock(74, 46, 14)],
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [7, new ErrorCorrectionCodePerBlock(54, 24, 15)],
                [16, new ErrorCorrectionCodePerBlock(55, 25, 15)],
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [34, new ErrorCorrectionCodePerBlock(37, 13, 12)],
            ],
        ]);
    }
}
