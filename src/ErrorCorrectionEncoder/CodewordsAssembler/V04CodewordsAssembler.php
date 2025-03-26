<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler;

use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) p. 35, table 14
 */
class V04CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [1, new CodewordsAssemblerUnit(100,80,10)]
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [2, new CodewordsAssemblerUnit(50, 32, 9)]
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [2, new CodewordsAssemblerUnit(50, 24, 13)]
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [4, new CodewordsAssemblerUnit(25, 9, 8)]
                ],
            ],
            $logger
        );
    }
}
