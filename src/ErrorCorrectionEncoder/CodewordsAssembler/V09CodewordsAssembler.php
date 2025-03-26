<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler;

use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) p. 36, table 14
 */
class V09CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [2, new CodewordsAssemblerUnit(146, 116, 15)],
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [3, new CodewordsAssemblerUnit(58, 36, 11)],
                    [2, new CodewordsAssemblerUnit(59, 37, 11)],
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [4, new CodewordsAssemblerUnit(36, 16, 10)],
                    [4, new CodewordsAssemblerUnit(37, 17, 10)],
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [4, new CodewordsAssemblerUnit(36, 12, 12)],
                    [4, new CodewordsAssemblerUnit(37, 13, 12)],
                ],
            ],
            $logger
        );
    }
}
