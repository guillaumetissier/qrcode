<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\DataEncoder\Version\VersionFromIntConverter;

class NumericMediumVersionSelector extends BaseVersionSelector
{
    public function __construct(VersionFromIntConverter $converter)
    {
        parent::__construct($converter, [
            Version::V01->toInt() => 34,
            Version::V02->toInt() => 63,
            Version::V03->toInt() => 101,
            Version::V04->toInt() => 149,
            Version::V05->toInt() => 202,
            Version::V06->toInt() => 255,
            Version::V07->toInt() => 293,
            Version::V08->toInt() => 365,
            Version::V09->toInt() => 432,
            Version::V10->toInt() => 513,
            Version::V11->toInt() => 604,
            Version::V12->toInt() => 691,
            Version::V13->toInt() => 796,
            Version::V14->toInt() => 871,
            Version::V15->toInt() => 991,
            Version::V16->toInt() => 1082,
            Version::V17->toInt() => 1212,
            Version::V18->toInt() => 1346,
            Version::V19->toInt() => 1500,
            Version::V20->toInt() => 1600,
            Version::V21->toInt() => 1708,
            Version::V22->toInt() => 1872,
            Version::V23->toInt() => 2059,
            Version::V24->toInt() => 2188,
            Version::V25->toInt() => 2395,
            Version::V26->toInt() => 2544,
            Version::V27->toInt() => 2701,
            Version::V28->toInt() => 2857,
            Version::V29->toInt() => 3035,
            Version::V30->toInt() => 3289,
            Version::V31->toInt() => 3486,
            Version::V32->toInt() => 3693,
            Version::V33->toInt() => 3909,
            Version::V34->toInt() => 4134,
            Version::V35->toInt() => 4343,
            Version::V36->toInt() => 4588,
            Version::V37->toInt() => 4775,
            Version::V38->toInt() => 5039,
            Version::V39->toInt() => 5313,
            Version::V40->toInt() => 5596,
        ]);
    }
}
