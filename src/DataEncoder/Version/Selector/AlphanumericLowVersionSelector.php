<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

class AlphanumericLowVersionSelector extends BaseVersionSelector
{
    public function __construct(LevelFilteredLogger $logger)
    {
        parent::__construct($logger, [
            Version::V01->value => 41,
            Version::V02->value => 77,
            Version::V03->value => 127,
            Version::V04->value => 187,
            Version::V05->value => 255,
            Version::V06->value => 322,
            Version::V07->value => 370,
            Version::V08->value => 461,
            Version::V09->value => 552,
            Version::V10->value => 652,
            Version::V11->value => 772,
            Version::V12->value => 883,
            Version::V13->value => 1022,
            Version::V14->value => 1101,
            Version::V15->value => 1250,
            Version::V16->value => 1408,
            Version::V17->value => 1548,
            Version::V18->value => 1725,
            Version::V19->value => 1903,
            Version::V20->value => 2061,
            Version::V21->value => 2232,
            Version::V22->value => 2409,
            Version::V23->value => 2620,
            Version::V24->value => 2812,
            Version::V25->value => 3057,
            Version::V26->value => 3283,
            Version::V27->value => 3517,
            Version::V28->value => 3669,
            Version::V29->value => 3909,
            Version::V30->value => 4158,
            Version::V31->value => 4417,
            Version::V32->value => 4686,
            Version::V33->value => 4965,
            Version::V34->value => 5253,
            Version::V35->value => 5529,
            Version::V36->value => 5836,
            Version::V37->value => 6153,
            Version::V38->value => 6479,
            Version::V39->value => 6743,
            Version::V40->value => 7089,
        ]);
    }
}
