<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version;

class ByteLowVersionSelector extends BaseVersionSelector
{
    public function __construct()
    {
        parent::__construct([
            Version::V01->toInt() => 17,
            Version::V02->toInt() => 32,
            Version::V03->toInt() => 53,
            Version::V04->toInt() => 78,
            Version::V05->toInt() => 106,
            Version::V06->toInt() => 134,
            Version::V07->toInt() => 154,
            Version::V08->toInt() => 192,
            Version::V09->toInt() => 230,
            Version::V10->toInt() => 271,
            Version::V11->toInt() => 321,
            Version::V12->toInt() => 367,
            Version::V13->toInt() => 425,
            Version::V14->toInt() => 458,
            Version::V15->toInt() => 520,
            Version::V16->toInt() => 586,
            Version::V17->toInt() => 644,
            Version::V18->toInt() => 718,
            Version::V19->toInt() => 792,
            Version::V20->toInt() => 858,
            Version::V21->toInt() => 929,
            Version::V22->toInt() => 1003,
            Version::V23->toInt() => 1091,
            Version::V24->toInt() => 1171,
            Version::V25->toInt() => 1273,
            Version::V26->toInt() => 1367,
            Version::V27->toInt() => 1465,
            Version::V28->toInt() => 1528,
            Version::V29->toInt() => 1628,
            Version::V30->toInt() => 1732,
            Version::V31->toInt() => 1840,
            Version::V32->toInt() => 1952,
            Version::V33->toInt() => 2068,
            Version::V34->toInt() => 2188,
            Version::V35->toInt() => 2303,
            Version::V36->toInt() => 2431,
            Version::V37->toInt() => 2563,
            Version::V38->toInt() => 2699,
            Version::V39->toInt() => 2809,
            Version::V40->toInt() => 2953,
        ]);
    }
}
