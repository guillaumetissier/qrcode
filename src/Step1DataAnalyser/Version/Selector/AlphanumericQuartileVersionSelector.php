<?php

namespace ThePhpGuild\QrCode\Step1DataAnalyser\Version\Selector;

use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class AlphanumericQuartileVersionSelector extends BaseVersionSelector
{
    public function __construct(IOLoggerInterface $logger)
    {
        /*
         * see https://www.qrcode.com/en/about/version.html
         * ISO/IEC 18004:2000(E) 8.4.9 (p28-32)
         */
        parent::__construct($logger, [
            Version::V01->value => 16,
            Version::V02->value => 29,
            Version::V03->value => 47,
            Version::V04->value => 67,
            Version::V05->value => 87,
            Version::V06->value => 108,
            Version::V07->value => 125,
            Version::V08->value => 157,
            Version::V09->value => 189,
            Version::V10->value => 221,
            Version::V11->value => 259,
            Version::V12->value => 296,
            Version::V13->value => 352,
            Version::V14->value => 376,
            Version::V15->value => 426,
            Version::V16->value => 470,
            Version::V17->value => 531,
            Version::V18->value => 574,
            Version::V19->value => 644,
            Version::V20->value => 702,
            Version::V21->value => 742,
            Version::V22->value => 823,
            Version::V23->value => 890,
            Version::V24->value => 963,
            Version::V25->value => 1041,
            Version::V26->value => 1094,
            Version::V27->value => 1172,
            Version::V28->value => 1263,
            Version::V29->value => 1322,
            Version::V30->value => 1429,
            Version::V31->value => 1499,
            Version::V32->value => 1618,
            Version::V33->value => 1700,
            Version::V34->value => 1787,
            Version::V35->value => 1867,
            Version::V36->value => 1966,
            Version::V37->value => 2071,
            Version::V38->value => 2181,
            Version::V39->value => 2298,
            Version::V40->value => 2420,
        ]);
    }
}