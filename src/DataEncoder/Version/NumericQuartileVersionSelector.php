<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version;

class NumericQuartileVersionSelector extends BaseVersionSelector
{
    public function __construct()
    {
        parent::__construct([
            Version::V01->toInt() => 27,
            Version::V02->toInt() => 48,
            Version::V03->toInt() => 77,
            Version::V04->toInt() => 111,
            Version::V05->toInt() => 144,
            Version::V06->toInt() => 178,
            Version::V07->toInt() => 207,
            Version::V08->toInt() => 259,
            Version::V09->toInt() => 312,
            Version::V10->toInt() => 364,
            Version::V11->toInt() => 427,
            Version::V12->toInt() => 489,
            Version::V13->toInt() => 580,
            Version::V14->toInt() => 621,
            Version::V15->toInt() => 703,
            Version::V16->toInt() => 775,
            Version::V17->toInt() => 876,
            Version::V18->toInt() => 948,
            Version::V19->toInt() => 1063,
            Version::V20->toInt() => 1159,
            Version::V21->toInt() => 1224,
            Version::V22->toInt() => 1358,
            Version::V23->toInt() => 1468,
            Version::V24->toInt() => 1588,
            Version::V25->toInt() => 1718,
            Version::V26->toInt() => 1804,
            Version::V27->toInt() => 1933,
            Version::V28->toInt() => 2085,
            Version::V29->toInt() => 2181,
            Version::V30->toInt() => 2358,
            Version::V31->toInt() => 2473,
            Version::V32->toInt() => 2670,
            Version::V33->toInt() => 2805,
            Version::V34->toInt() => 2949,
            Version::V35->toInt() => 3081,
            Version::V36->toInt() => 3244,
            Version::V37->toInt() => 3417,
            Version::V38->toInt() => 3599,
            Version::V39->toInt() => 3791,
            Version::V40->toInt() => 3993
        ]);
    }
}