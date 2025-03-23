<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

class ByteHighVersionSelector extends BaseVersionSelector
{
    public function __construct(LevelFilteredLogger $logger)
    {
        /*
         * see https://www.qrcode.com/en/about/version.html
         * ISO/IEC 18004:2000(E) 8.4.9 (p28-32)
         */
        parent::__construct($logger, [
            Version::V01->value => 7,
            Version::V02->value => 14,
            Version::V03->value => 24,
            Version::V04->value => 34,
            Version::V05->value => 44,
            Version::V06->value => 58,
            Version::V07->value => 64,
            Version::V08->value => 84,
            Version::V09->value => 98,
            Version::V10->value => 119,
            Version::V11->value => 137,
            Version::V12->value => 155,
            Version::V13->value => 177,
            Version::V14->value => 194,
            Version::V15->value => 220,
            Version::V16->value => 250,
            Version::V17->value => 280,
            Version::V18->value => 310,
            Version::V19->value => 338,
            Version::V20->value => 382,
            Version::V21->value => 403,
            Version::V22->value => 439,
            Version::V23->value => 461,
            Version::V24->value => 511,
            Version::V25->value => 535,
            Version::V26->value => 593,
            Version::V27->value => 625,
            Version::V28->value => 658,
            Version::V29->value => 698,
            Version::V30->value => 742,
            Version::V31->value => 790,
            Version::V32->value => 842,
            Version::V33->value => 898,
            Version::V34->value => 958,
            Version::V35->value => 983,
            Version::V36->value => 1051,
            Version::V37->value => 1093,
            Version::V38->value => 1139,
            Version::V39->value => 1219,
            Version::V40->value => 1273,
        ]);
    }
}
