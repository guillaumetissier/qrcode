<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version;

class ByteQuartileVersionSelector extends BaseVersionSelector
{
    public function __construct()
    {
        parent::__construct([
            Version::V01->toInt() => 11,
            Version::V02->toInt() => 20,
            Version::V03->toInt() => 32,
            Version::V04->toInt() => 46,
            Version::V05->toInt() => 60,
            Version::V06->toInt() => 74,
            Version::V07->toInt() => 86,
            Version::V08->toInt() => 108,
            Version::V09->toInt() => 130,
            Version::V10->toInt() => 151,
            Version::V11->toInt() => 177,
            Version::V12->toInt() => 203,
            Version::V13->toInt() => 241,
            Version::V14->toInt() => 258,
            Version::V15->toInt() => 292,
            Version::V16->toInt() => 322,
            Version::V17->toInt() => 364,
            Version::V18->toInt() => 394,
            Version::V19->toInt() => 442,
            Version::V20->toInt() => 482,
            Version::V21->toInt() => 509,
            Version::V22->toInt() => 565,
            Version::V23->toInt() => 611,
            Version::V24->toInt() => 661,
            Version::V25->toInt() => 715,
            Version::V26->toInt() => 751,
            Version::V27->toInt() => 805,
            Version::V28->toInt() => 868,
            Version::V29->toInt() => 908,
            Version::V30->toInt() => 982,
            Version::V31->toInt() => 1030,
            Version::V32->toInt() => 1112,
            Version::V33->toInt() => 1168,
            Version::V34->toInt() => 1228,
            Version::V35->toInt() => 1283,
            Version::V36->toInt() => 1351,
            Version::V37->toInt() => 1423,
            Version::V38->toInt() => 1499,
            Version::V39->toInt() => 1579,
            Version::V40->toInt() => 1663,
        ]);
    }
}
