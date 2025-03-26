<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler;

use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) p. 39, table 14
 */
class V19CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [3, new CodewordsAssemblerUnit(141, 113, 14)],
                    [4, new CodewordsAssemblerUnit(142, 114, 14)],
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [3, new CodewordsAssemblerUnit(70, 44, 13)],
                    [11, new CodewordsAssemblerUnit(71, 45, 13)],
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [17, new CodewordsAssemblerUnit(47, 21, 13)],
                    [4, new CodewordsAssemblerUnit(48, 22, 13)],
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [9, new CodewordsAssemblerUnit(39, 13, 13)],
                    [16, new CodewordsAssemblerUnit(40, 14, 13)],
                ],
            ],
            $logger
        );
    }
}
