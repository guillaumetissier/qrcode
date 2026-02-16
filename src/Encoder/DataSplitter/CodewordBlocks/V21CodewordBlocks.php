<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 39, table 14
 */
final class V21CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [4, new ErrorCorrectionCodePerBlock(144, 116, 14)],
                [4, new ErrorCorrectionCodePerBlock(145, 117, 14)],
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [17, new ErrorCorrectionCodePerBlock(68, 42, 13)],
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [17, new ErrorCorrectionCodePerBlock(50, 22, 14)],
                [6, new ErrorCorrectionCodePerBlock(51, 23, 14)],
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [19, new ErrorCorrectionCodePerBlock(46, 16, 15)],
                [6, new ErrorCorrectionCodePerBlock(47, 17, 15)],
            ],
        ]);
    }
}
