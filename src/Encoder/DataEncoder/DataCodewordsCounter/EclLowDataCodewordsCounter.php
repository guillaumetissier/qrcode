<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter;

use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class EclLowDataCodewordsCounter extends AbstractDataCodewordsCounter
{
    /**
     * @throws MissingInfoException
     */
    public function count(): int
    {
        if ($this->version === null) {
            throw MissingInfoException::missingInfo('version', self::class);
        }

        return [
            Version::V01->value => 19,
            Version::V02->value => 34,
            Version::V03->value => 55,
            Version::V04->value => 80,
            Version::V05->value => 108,
            Version::V06->value => 136,
            Version::V07->value => 156,
            Version::V08->value => 194,
            Version::V09->value => 232,
            Version::V10->value => 274,
            Version::V11->value => 324,
            Version::V12->value => 370,
            Version::V13->value => 428,
            Version::V14->value => 461,
            Version::V15->value => 523,
            Version::V16->value => 589,
            Version::V17->value => 647,
            Version::V18->value => 721,
            Version::V19->value => 795,
            Version::V20->value => 861,
            Version::V21->value => 932,
            Version::V22->value => 1006,
            Version::V23->value => 1094,
            Version::V24->value => 1174,
            Version::V25->value => 1276,
            Version::V26->value => 1370,
            Version::V27->value => 1468,
            Version::V28->value => 1531,
            Version::V29->value => 1631,
            Version::V30->value => 1735,
            Version::V31->value => 1843,
            Version::V32->value => 1955,
            Version::V33->value => 2071,
            Version::V34->value => 2191,
            Version::V35->value => 2306,
            Version::V36->value => 2434,
            Version::V37->value => 2566,
            Version::V38->value => 2702,
            Version::V39->value => 2812,
            Version::V40->value => 2956,
        ][$this->version->value];
    }
}
