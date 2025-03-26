<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class NumericHighVersionSelector extends BaseVersionSelector
{
    public function __construct(IOLoggerInterface $logger)
    {
        /*
         * see https://www.qrcode.com/en/about/version.html
         * ISO/IEC 18004:2000(E) 8.4.9 (p28-32)
         */
        parent::__construct($logger, [
            Version::V01->value => 17,
            Version::V02->value => 34,
            Version::V03->value => 58,
            Version::V04->value => 82,
            Version::V05->value => 106,
            Version::V06->value => 139,
            Version::V07->value => 154,
            Version::V08->value => 202,
            Version::V09->value => 235,
            Version::V10->value => 288,
            Version::V11->value => 331,
            Version::V12->value => 374,
            Version::V13->value => 427,
            Version::V14->value => 468,
            Version::V15->value => 530,
            Version::V16->value => 602,
            Version::V17->value => 674,
            Version::V18->value => 746,
            Version::V19->value => 813,
            Version::V20->value => 919,
            Version::V21->value => 969,
            Version::V22->value => 1056,
            Version::V23->value => 1108,
            Version::V24->value => 1228,
            Version::V25->value => 1286,
            Version::V26->value => 1425,
            Version::V27->value => 1501,
            Version::V28->value => 1581,
            Version::V29->value => 1677,
            Version::V30->value => 1782,
            Version::V31->value => 1897,
            Version::V32->value => 2022,
            Version::V33->value => 2157,
            Version::V34->value => 2301,
            Version::V35->value => 2361,
            Version::V36->value => 2524,
            Version::V37->value => 2625,
            Version::V38->value => 2735,
            Version::V39->value => 2927,
            Version::V40->value => 3057,
        ]);
    }
}