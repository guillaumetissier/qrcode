<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler;

use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) p. 35, table 14
 */
class V05CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [1, new CodewordsAssemblerUnit(134, 108, 13)]
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [2, new CodewordsAssemblerUnit(67, 43, 12)]
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [2, new CodewordsAssemblerUnit(33, 15, 9)],
                    [2, new CodewordsAssemblerUnit(34, 16, 9)]
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [2, new CodewordsAssemblerUnit(33, 11, 11)],
                    [2, new CodewordsAssemblerUnit(34, 12, 11)]
                ],
            ],
            $logger
        );
    }
}
