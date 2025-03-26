<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler;

use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) p. 35, table 14
 */
class V01CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [1, new CodewordsAssemblerUnit(26, 19, 2)]
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [1, new CodewordsAssemblerUnit(26, 16, 4)]
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [1, new CodewordsAssemblerUnit(26, 13, 6)]
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [1, new CodewordsAssemblerUnit(26, 9, 8)]
                ],
            ],
            $logger
        );
    }
}
