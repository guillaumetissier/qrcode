<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\DataEncoder\Version\VersionFromIntConverter;

class ByteMediumVersionSelector extends BaseVersionSelector
{
    public function __construct(VersionFromIntConverter $converter)
    {
        parent::__construct($converter, [
            Version::V01->toInt() => 14,
            Version::V02->toInt() => 26,
            Version::V03->toInt() => 42,
            Version::V04->toInt() => 62,
            Version::V05->toInt() => 84,
            Version::V06->toInt() => 106,
            Version::V07->toInt() => 122,
            Version::V08->toInt() => 152,
            Version::V09->toInt() => 180,
            Version::V10->toInt() => 213,
            Version::V11->toInt() => 251,
            Version::V12->toInt() => 287,
            Version::V13->toInt() => 331,
            Version::V14->toInt() => 362,
            Version::V15->toInt() => 412,
            Version::V16->toInt() => 450,
            Version::V17->toInt() => 504,
            Version::V18->toInt() => 560,
            Version::V19->toInt() => 624,
            Version::V20->toInt() => 666,
            Version::V21->toInt() => 711,
            Version::V22->toInt() => 779,
            Version::V23->toInt() => 857,
            Version::V24->toInt() => 911,
            Version::V25->toInt() => 997,
            Version::V26->toInt() => 1059,
            Version::V27->toInt() => 1125,
            Version::V28->toInt() => 1190,
            Version::V29->toInt() => 1264,
            Version::V30->toInt() => 1370,
            Version::V31->toInt() => 1452,
            Version::V32->toInt() => 1538,
            Version::V33->toInt() => 1628,
            Version::V34->toInt() => 1722,
            Version::V35->toInt() => 1809,
            Version::V36->toInt() => 1911,
            Version::V37->toInt() => 1989,
            Version::V38->toInt() => 2099,
            Version::V39->toInt() => 2213,
            Version::V40->toInt() => 2331,
        ]);
    }
}
