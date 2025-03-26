<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class AlphanumericHighVersionSelector extends BaseVersionSelector
{
    public function __construct(IOLoggerInterface $logger)
    {
        /*
         * see https://www.qrcode.com/en/about/version.html
         * ISO/IEC 18004:2000(E) 8.4.9 (p28-32)
         */
        parent::__construct($logger, [
            Version::V01->value => 10,
            Version::V02->value => 20,
            Version::V03->value => 35,
            Version::V04->value => 50,
            Version::V05->value => 64,
            Version::V06->value => 84,
            Version::V07->value => 93,
            Version::V08->value => 122,
            Version::V09->value => 143,
            Version::V10->value => 174,
            Version::V11->value => 200,
            Version::V12->value => 227,
            Version::V13->value => 259,
            Version::V14->value => 283,
            Version::V15->value => 321,
            Version::V16->value => 365,
            Version::V17->value => 408,
            Version::V18->value => 452,
            Version::V19->value => 493,
            Version::V20->value => 557,
            Version::V21->value => 587,
            Version::V22->value => 640,
            Version::V23->value => 672,
            Version::V24->value => 744,
            Version::V25->value => 779,
            Version::V26->value => 864,
            Version::V27->value => 910,
            Version::V28->value => 958,
            Version::V29->value => 1016,
            Version::V30->value => 1080,
            Version::V31->value => 1150,
            Version::V32->value => 1226,
            Version::V33->value => 1307,
            Version::V34->value => 1394,
            Version::V35->value => 1431,
            Version::V36->value => 1530,
            Version::V37->value => 1591,
            Version::V38->value => 1658,
            Version::V39->value => 1774,
            Version::V40->value => 1852,
        ]);
    }
}