<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector;

use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class ByteQuartileVersionSelector extends BaseVersionSelector
{
    public function __construct(?IOLoggerInterface $logger = null)
    {
        /*
         * see https://www.qrcode.com/en/about/version.html
         * ISO/IEC 18004:2000(E) 8.4.9 (p28-32)
         */
        parent::__construct([
            Version::V01->value => 11,
            Version::V02->value => 20,
            Version::V03->value => 32,
            Version::V04->value => 46,
            Version::V05->value => 60,
            Version::V06->value => 74,
            Version::V07->value => 86,
            Version::V08->value => 108,
            Version::V09->value => 130,
            Version::V10->value => 151,
            Version::V11->value => 177,
            Version::V12->value => 203,
            Version::V13->value => 241,
            Version::V14->value => 258,
            Version::V15->value => 292,
            Version::V16->value => 322,
            Version::V17->value => 364,
            Version::V18->value => 394,
            Version::V19->value => 442,
            Version::V20->value => 482,
            Version::V21->value => 509,
            Version::V22->value => 565,
            Version::V23->value => 611,
            Version::V24->value => 661,
            Version::V25->value => 715,
            Version::V26->value => 751,
            Version::V27->value => 805,
            Version::V28->value => 868,
            Version::V29->value => 908,
            Version::V30->value => 982,
            Version::V31->value => 1030,
            Version::V32->value => 1112,
            Version::V33->value => 1168,
            Version::V34->value => 1228,
            Version::V35->value => 1283,
            Version::V36->value => 1351,
            Version::V37->value => 1423,
            Version::V38->value => 1499,
            Version::V39->value => 1579,
            Version::V40->value => 1663,
        ], $logger);
    }
}
