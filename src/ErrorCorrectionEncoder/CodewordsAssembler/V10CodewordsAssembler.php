<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler;

use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) p. 36, table 14
 */
class V10CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [2, new CodewordsAssemblerUnit(86, 68, 9)],
                    [2, new CodewordsAssemblerUnit(87, 69, 9)],
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [4, new CodewordsAssemblerUnit(69, 43, 13)],
                    [1, new CodewordsAssemblerUnit(70, 44, 13)],
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [6, new CodewordsAssemblerUnit(43, 19, 12)],
                    [2, new CodewordsAssemblerUnit(44, 20, 12)],
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [6, new CodewordsAssemblerUnit(43, 15, 14)],
                    [2, new CodewordsAssemblerUnit(44, 16, 14)],
                ],
            ],
            $logger
        );
    }
}
