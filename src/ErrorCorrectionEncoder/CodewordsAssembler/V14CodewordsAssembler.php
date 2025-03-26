<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler;

use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) p. 37, table 14
 */
class V14CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [3, new CodewordsAssemblerUnit(145, 115, 15)],
                    [1, new CodewordsAssemblerUnit(146, 116, 15)],
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [4, new CodewordsAssemblerUnit(64, 40, 12)],
                    [5, new CodewordsAssemblerUnit(65, 41, 12)],
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [11, new CodewordsAssemblerUnit(36, 16, 10)],
                    [5, new CodewordsAssemblerUnit(37, 17, 10)],
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [11, new CodewordsAssemblerUnit(36, 12, 12)],
                    [5, new CodewordsAssemblerUnit(37, 13, 12)],
                ],
            ],
            $logger
        );
    }
}
