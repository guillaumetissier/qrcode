<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class NumericHighVersionSelector extends BaseVersionSelector
{
    public function __construct()
    {
        parent::__construct([
            Version::V01->toInt() => 17,
            Version::V02->toInt() => 34,
            Version::V03->toInt() => 58,
            Version::V04->toInt() => 82,
            Version::V05->toInt() => 106,
            Version::V06->toInt() => 139,
            Version::V07->toInt() => 154,
            Version::V08->toInt() => 202,
            Version::V09->toInt() => 235,
            Version::V10->toInt() => 288,
            Version::V11->toInt() => 331,
            Version::V12->toInt() => 374,
            Version::V13->toInt() => 427,
            Version::V14->toInt() => 468,
            Version::V15->toInt() => 530,
            Version::V16->toInt() => 602,
            Version::V17->toInt() => 674,
            Version::V18->toInt() => 746,
            Version::V19->toInt() => 813,
            Version::V20->toInt() => 919,
            Version::V21->toInt() => 969,
            Version::V22->toInt() => 1056,
            Version::V23->toInt() => 1108,
            Version::V24->toInt() => 1228,
            Version::V25->toInt() => 1286,
            Version::V26->toInt() => 1425,
            Version::V27->toInt() => 1501,
            Version::V28->toInt() => 1581,
            Version::V29->toInt() => 1677,
            Version::V30->toInt() => 1782,
            Version::V31->toInt() => 1897,
            Version::V32->toInt() => 2022,
            Version::V33->toInt() => 2157,
            Version::V34->toInt() => 2301,
            Version::V35->toInt() => 2361,
            Version::V36->toInt() => 2524,
            Version::V37->toInt() => 2625,
            Version::V38->toInt() => 2735,
            Version::V39->toInt() => 2927,
            Version::V40->toInt() => 3057,
        ]);
    }
}