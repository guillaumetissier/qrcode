<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler;

use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) p. 39, table 14
 */
class V21CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [4, new CodewordsAssemblerUnit(144, 116, 14)],
                    [4, new CodewordsAssemblerUnit(145, 117, 14)],
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [17, new CodewordsAssemblerUnit(68, 42, 13)],
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [17, new CodewordsAssemblerUnit(50, 22, 14)],
                    [6, new CodewordsAssemblerUnit(51, 23, 14)],
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [19, new CodewordsAssemblerUnit(46, 16, 15)],
                    [6, new CodewordsAssemblerUnit(47, 17, 15)],
                ],
            ],
            $logger
        );
    }
}
