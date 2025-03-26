<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler;

use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) p. 38, table 14
 */
class V17CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [1, new CodewordsAssemblerUnit(135, 107, 14)],
                    [5, new CodewordsAssemblerUnit(136, 108, 14)],
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [10, new CodewordsAssemblerUnit(74,46,14)],
                    [1, new CodewordsAssemblerUnit(75,47,14)],
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [1, new CodewordsAssemblerUnit(50, 22, 14)],
                    [15, new CodewordsAssemblerUnit(51, 23, 14)],
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [2, new CodewordsAssemblerUnit(42, 14, 14)],
                    [17, new CodewordsAssemblerUnit(43, 15, 14)],
                ],
            ],
            $logger
        );
    }
}
