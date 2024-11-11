<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version;

class NumericLowVersionSelector extends BaseVersionSelector
{
    public function __construct()
    {
        parent::__construct([
            Version::V01->toInt() => 41,
            Version::V02->toInt() => 77,
            Version::V03->toInt() => 127,
            Version::V04->toInt() => 187,
            Version::V05->toInt() => 255,
            Version::V06->toInt() => 322,
            Version::V07->toInt() => 370,
            Version::V08->toInt() => 461,
            Version::V09->toInt() => 552,
            Version::V10->toInt() => 652,
            Version::V11->toInt() => 772,
            Version::V12->toInt() => 883,
            Version::V13->toInt() => 1022,
            Version::V14->toInt() => 1101,
            Version::V15->toInt() => 1250,
            Version::V16->toInt() => 1408,
            Version::V17->toInt() => 1548,
            Version::V18->toInt() => 1725,
            Version::V19->toInt() => 1903,
            Version::V20->toInt() => 2061,
            Version::V21->toInt() => 2232,
            Version::V22->toInt() => 2409,
            Version::V23->toInt() => 2620,
            Version::V24->toInt() => 2812,
            Version::V25->toInt() => 3057,
            Version::V26->toInt() => 3283,
            Version::V27->toInt() => 3517,
            Version::V28->toInt() => 3669,
            Version::V29->toInt() => 3909,
            Version::V30->toInt() => 4158,
            Version::V31->toInt() => 4417,
            Version::V32->toInt() => 4686,
            Version::V33->toInt() => 4965,
            Version::V34->toInt() => 5253,
            Version::V35->toInt() => 5529,
            Version::V36->toInt() => 5836,
            Version::V37->toInt() => 6153,
            Version::V38->toInt() => 6479,
            Version::V39->toInt() => 6743,
            Version::V40->toInt() => 7089,
        ]);
    }
}
