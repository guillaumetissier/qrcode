<?php

namespace ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) p. 37, table 14
 */
class V13CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [4, new CodewordsAssemblerUnit(133, 107, 13)],
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [8, new CodewordsAssemblerUnit(59, 37, 11)],
                    [1, new CodewordsAssemblerUnit(60, 38, 11)],
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [8, new CodewordsAssemblerUnit(44, 20, 12)],
                    [4, new CodewordsAssemblerUnit(45, 21, 12)],
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [12, new CodewordsAssemblerUnit(33, 11, 11)],
                    [4, new CodewordsAssemblerUnit(34, 12, 11)],
                ],
            ],
            $logger
        );
    }
}
