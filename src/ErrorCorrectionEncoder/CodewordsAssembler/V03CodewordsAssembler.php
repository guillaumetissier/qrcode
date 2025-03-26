<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler;

use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) p. 35, table 14
 */
class V03CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [1, new CodewordsAssemblerUnit(70, 55, 7)]
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [1, new CodewordsAssemblerUnit(70, 44, 13)]
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [2, new CodewordsAssemblerUnit(35, 17, 9)]
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [2, new CodewordsAssemblerUnit(35, 13, 11)]
                ],
            ],
            $logger
        );
    }
}
