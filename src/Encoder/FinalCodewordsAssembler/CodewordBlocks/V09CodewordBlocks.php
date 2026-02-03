<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) p. 36, table 14
 */
final class V09CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [2, new ErrorCorrectionCodePerBlock(146, 116, 15)],
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [3, new ErrorCorrectionCodePerBlock(58, 36, 11)],
                [2, new ErrorCorrectionCodePerBlock(59, 37, 11)],
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [4, new ErrorCorrectionCodePerBlock(36, 16, 10)],
                [4, new ErrorCorrectionCodePerBlock(37, 17, 10)],
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [4, new ErrorCorrectionCodePerBlock(36, 12, 12)],
                [4, new ErrorCorrectionCodePerBlock(37, 13, 12)],
            ],
        ]);
    }
}
