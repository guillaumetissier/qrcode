<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class NumericMediumVersionSelector extends BaseVersionSelector
{
    /*
     * see https://www.qrcode.com/en/about/version.html checked
     * ISO/IEC 18004:2000(E) 8.4.9 (p28-32)
     */
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct($logger, [
            Version::V01->value => 34,
            Version::V02->value => 63,
            Version::V03->value => 101,
            Version::V04->value => 149,
            Version::V05->value => 202,
            Version::V06->value => 255,
            Version::V07->value => 293,
            Version::V08->value => 365,
            Version::V09->value => 432,
            Version::V10->value => 513,
            Version::V11->value => 604,
            Version::V12->value => 691,
            Version::V13->value => 796,
            Version::V14->value => 871,
            Version::V15->value => 991,
            Version::V16->value => 1082,
            Version::V17->value => 1212,
            Version::V18->value => 1346,
            Version::V19->value => 1500,
            Version::V20->value => 1600,
            Version::V21->value => 1708,
            Version::V22->value => 1872,
            Version::V23->value => 2059,
            Version::V24->value => 2188,
            Version::V25->value => 2395,
            Version::V26->value => 2544,
            Version::V27->value => 2701,
            Version::V28->value => 2857,
            Version::V29->value => 3035,
            Version::V30->value => 3289,
            Version::V31->value => 3486,
            Version::V32->value => 3693,
            Version::V33->value => 3909,
            Version::V34->value => 4134,
            Version::V35->value => 4343,
            Version::V36->value => 4588,
            Version::V37->value => 4775,
            Version::V38->value => 5039,
            Version::V39->value => 5313,
            Version::V40->value => 5596,
        ]);
    }
}
