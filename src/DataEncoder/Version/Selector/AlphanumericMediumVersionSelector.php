<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class AlphanumericMediumVersionSelector extends BaseVersionSelector
{
    public function __construct(IOLoggerInterface $logger)
    {
        /*
         * see https://www.qrcode.com/en/about/version.html
         * ISO/IEC 18004:2000(E) 8.4.9 (p28-32)
         */
        parent::__construct($logger, [
            Version::V01->value => 20,
            Version::V02->value => 38,
            Version::V03->value => 61,
            Version::V04->value => 90,
            Version::V05->value => 122,
            Version::V06->value => 154,
            Version::V07->value => 178,
            Version::V08->value => 221,
            Version::V09->value => 262,
            Version::V10->value => 311,
            Version::V11->value => 366,
            Version::V12->value => 419,
            Version::V13->value => 483,
            Version::V14->value => 528,
            Version::V15->value => 600,
            Version::V16->value => 656,
            Version::V17->value => 734,
            Version::V18->value => 816,
            Version::V19->value => 909,
            Version::V20->value => 970,
            Version::V21->value => 1035,
            Version::V22->value => 1134,
            Version::V23->value => 1248,
            Version::V24->value => 1326,
            Version::V25->value => 1451,
            Version::V26->value => 1542,
            Version::V27->value => 1637,
            Version::V28->value => 1732,
            Version::V29->value => 1839,
            Version::V30->value => 1994,
            Version::V31->value => 2113,
            Version::V32->value => 2238,
            Version::V33->value => 2369,
            Version::V34->value => 2506,
            Version::V35->value => 2632,
            Version::V36->value => 2780,
            Version::V37->value => 2894,
            Version::V38->value => 3054,
            Version::V39->value => 3220,
            Version::V40->value => 3391,
        ]);
    }
}