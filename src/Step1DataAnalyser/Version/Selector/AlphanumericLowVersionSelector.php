<?php

namespace ThePhpGuild\QrCode\Step1DataAnalyser\Version\Selector;

use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class AlphanumericLowVersionSelector extends BaseVersionSelector
{
    public function __construct(IOLoggerInterface $logger)
    {
        /*
         * see https://www.qrcode.com/en/about/version.html
         * ISO/IEC 18004:2000(E) 8.4.9 (p28-32)
         */
        parent::__construct($logger, [
            Version::V01->value => 25,
            Version::V02->value => 47,
            Version::V03->value => 77,
            Version::V04->value => 114,
            Version::V05->value => 154,
            Version::V06->value => 195,
            Version::V07->value => 224,
            Version::V08->value => 279,
            Version::V09->value => 335,
            Version::V10->value => 395,
            Version::V11->value => 468,
            Version::V12->value => 535,
            Version::V13->value => 619,
            Version::V14->value => 667,
            Version::V15->value => 758,
            Version::V16->value => 854,
            Version::V17->value => 938,
            Version::V18->value => 1046,
            Version::V19->value => 1153,
            Version::V20->value => 1249,
            Version::V21->value => 1352,
            Version::V22->value => 1460,
            Version::V23->value => 1588,
            Version::V24->value => 1704,
            Version::V25->value => 1853,
            Version::V26->value => 1990,
            Version::V27->value => 2132,
            Version::V28->value => 2223,
            Version::V29->value => 2369,
            Version::V30->value => 2520,
            Version::V31->value => 2677,
            Version::V32->value => 2840,
            Version::V33->value => 3009,
            Version::V34->value => 3183,
            Version::V35->value => 3351,
            Version::V36->value => 3537,
            Version::V37->value => 3729,
            Version::V38->value => 3927,
            Version::V39->value => 4087,
            Version::V40->value => 4296,
        ]);
    }
}
