<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class ByteHighVersionSelector extends BaseVersionSelector
{
    public function __construct()
    {
        parent::__construct([
            Version::V01->toInt() => 7,
            Version::V02->toInt() => 14,
            Version::V03->toInt() => 24,
            Version::V04->toInt() => 34,
            Version::V05->toInt() => 44,
            Version::V06->toInt() => 58,
            Version::V07->toInt() => 64,
            Version::V08->toInt() => 84,
            Version::V09->toInt() => 98,
            Version::V10->toInt() => 119,
            Version::V11->toInt() => 137,
            Version::V12->toInt() => 155,
            Version::V13->toInt() => 177,
            Version::V14->toInt() => 194,
            Version::V15->toInt() => 220,
            Version::V16->toInt() => 250,
            Version::V17->toInt() => 280,
            Version::V18->toInt() => 310,
            Version::V19->toInt() => 338,
            Version::V20->toInt() => 382,
            Version::V21->toInt() => 403,
            Version::V22->toInt() => 439,
            Version::V23->toInt() => 461,
            Version::V24->toInt() => 511,
            Version::V25->toInt() => 535,
            Version::V26->toInt() => 593,
            Version::V27->toInt() => 625,
            Version::V28->toInt() => 658,
            Version::V29->toInt() => 698,
            Version::V30->toInt() => 742,
            Version::V31->toInt() => 790,
            Version::V32->toInt() => 842,
            Version::V33->toInt() => 898,
            Version::V34->toInt() => 958,
            Version::V35->toInt() => 983,
            Version::V36->toInt() => 1051,
            Version::V37->toInt() => 1093,
            Version::V38->toInt() => 1139,
            Version::V39->toInt() => 1219,
            Version::V40->toInt() => 1273,
        ]);
    }
}
