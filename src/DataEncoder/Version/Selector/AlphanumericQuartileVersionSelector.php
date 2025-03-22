<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

class AlphanumericQuartileVersionSelector extends BaseVersionSelector
{
    public function __construct(LevelFilteredLogger $logger)
    {
        parent::__construct($logger, [
            Version::V01->value => 27,
            Version::V02->value => 48,
            Version::V03->value => 77,
            Version::V04->value => 111,
            Version::V05->value => 144,
            Version::V06->value => 178,
            Version::V07->value => 207,
            Version::V08->value => 259,
            Version::V09->value => 312,
            Version::V10->value => 364,
            Version::V11->value => 427,
            Version::V12->value => 489,
            Version::V13->value => 580,
            Version::V14->value => 621,
            Version::V15->value => 703,
            Version::V16->value => 775,
            Version::V17->value => 876,
            Version::V18->value => 948,
            Version::V19->value => 1063,
            Version::V20->value => 1159,
            Version::V21->value => 1224,
            Version::V22->value => 1358,
            Version::V23->value => 1468,
            Version::V24->value => 1588,
            Version::V25->value => 1718,
            Version::V26->value => 1804,
            Version::V27->value => 1933,
            Version::V28->value => 2085,
            Version::V29->value => 2181,
            Version::V30->value => 2358,
            Version::V31->value => 2473,
            Version::V32->value => 2670,
            Version::V33->value => 2805,
            Version::V34->value => 2949,
            Version::V35->value => 3081,
            Version::V36->value => 3244,
            Version::V37->value => 3417,
            Version::V38->value => 3599,
            Version::V39->value => 3791,
            Version::V40->value => 3993
        ]);
    }
}