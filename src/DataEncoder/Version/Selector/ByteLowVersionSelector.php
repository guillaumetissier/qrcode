<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

class ByteLowVersionSelector extends BaseVersionSelector
{
    public function __construct(LevelFilteredLogger $logger)
    {
        /*
         * see https://www.qrcode.com/en/about/version.html
         * ISO/IEC 18004:2000(E) 8.4.9 (p28-32)
         */
        parent::__construct($logger, [
            Version::V01->value => 17,
            Version::V02->value => 32,
            Version::V03->value => 53,
            Version::V04->value => 78,
            Version::V05->value => 106,
            Version::V06->value => 134,
            Version::V07->value => 154,
            Version::V08->value => 192,
            Version::V09->value => 230,
            Version::V10->value => 271,
            Version::V11->value => 321,
            Version::V12->value => 367,
            Version::V13->value => 425,
            Version::V14->value => 458,
            Version::V15->value => 520,
            Version::V16->value => 586,
            Version::V17->value => 644,
            Version::V18->value => 718,
            Version::V19->value => 792,
            Version::V20->value => 858,
            Version::V21->value => 929,
            Version::V22->value => 1003,
            Version::V23->value => 1091,
            Version::V24->value => 1171,
            Version::V25->value => 1273,
            Version::V26->value => 1367,
            Version::V27->value => 1465,
            Version::V28->value => 1528,
            Version::V29->value => 1628,
            Version::V30->value => 1732,
            Version::V31->value => 1840,
            Version::V32->value => 1952,
            Version::V33->value => 2068,
            Version::V34->value => 2188,
            Version::V35->value => 2303,
            Version::V36->value => 2431,
            Version::V37->value => 2563,
            Version::V38->value => 2699,
            Version::V39->value => 2809,
            Version::V40->value => 2953,
        ]);
    }
}
