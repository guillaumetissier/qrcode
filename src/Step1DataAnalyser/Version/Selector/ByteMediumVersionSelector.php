<?php

namespace ThePhpGuild\QrCode\Step1DataAnalyser\Version\Selector;

use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class ByteMediumVersionSelector extends BaseVersionSelector
{
    public function __construct(IOLoggerInterface $logger)
    {
        /*
         * see https://www.qrcode.com/en/about/version.html
         * ISO/IEC 18004:2000(E) 8.4.9 (p28-32)
         */
        parent::__construct($logger, [
            Version::V01->value => 14,
            Version::V02->value => 26,
            Version::V03->value => 42,
            Version::V04->value => 62,
            Version::V05->value => 84,
            Version::V06->value => 106,
            Version::V07->value => 122,
            Version::V08->value => 152,
            Version::V09->value => 180,
            Version::V10->value => 213,
            Version::V11->value => 251,
            Version::V12->value => 287,
            Version::V13->value => 331,
            Version::V14->value => 362,
            Version::V15->value => 412,
            Version::V16->value => 450,
            Version::V17->value => 504,
            Version::V18->value => 560,
            Version::V19->value => 624,
            Version::V20->value => 666,
            Version::V21->value => 711,
            Version::V22->value => 779,
            Version::V23->value => 857,
            Version::V24->value => 911,
            Version::V25->value => 997,
            Version::V26->value => 1059,
            Version::V27->value => 1125,
            Version::V28->value => 1190,
            Version::V29->value => 1264,
            Version::V30->value => 1370,
            Version::V31->value => 1452,
            Version::V32->value => 1538,
            Version::V33->value => 1628,
            Version::V34->value => 1722,
            Version::V35->value => 1809,
            Version::V36->value => 1911,
            Version::V37->value => 1989,
            Version::V38->value => 2099,
            Version::V39->value => 2213,
            Version::V40->value => 2331,
        ]);
    }
}
