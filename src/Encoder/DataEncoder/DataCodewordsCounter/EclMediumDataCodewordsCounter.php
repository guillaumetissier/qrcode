<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter;

use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class EclMediumDataCodewordsCounter extends AbstractDataCodewordsCounter
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
            Version::V01->value => 16,
            Version::V02->value => 28,
            Version::V03->value => 44,
            Version::V04->value => 64,
            Version::V05->value => 86,
            Version::V06->value => 108,
            Version::V07->value => 124,
            Version::V08->value => 154,
            Version::V09->value => 182,
            Version::V10->value => 216,
            Version::V11->value => 254,
            Version::V12->value => 290,
            Version::V13->value => 334,
            Version::V14->value => 365,
            Version::V15->value => 415,
            Version::V16->value => 453,
            Version::V17->value => 507,
            Version::V18->value => 563,
            Version::V19->value => 627,
            Version::V20->value => 669,
            Version::V21->value => 714,
            Version::V22->value => 782,
            Version::V23->value => 860,
            Version::V24->value => 914,
            Version::V25->value => 1000,
            Version::V26->value => 1062,
            Version::V27->value => 1128,
            Version::V28->value => 1193,
            Version::V29->value => 1267,
            Version::V30->value => 1373,
            Version::V31->value => 1455,
            Version::V32->value => 1541,
            Version::V33->value => 1631,
            Version::V34->value => 1725,
            Version::V35->value => 1812,
            Version::V36->value => 1914,
            Version::V37->value => 1992,
            Version::V38->value => 2102,
            Version::V39->value => 2216,
            Version::V40->value => 2334,
        ][$this->version->value];
    }
}
