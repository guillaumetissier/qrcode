<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter;

use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class EclQuartileDataCodewordsCounter extends AbstractDataCodewordsCounter
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
            Version::V01->value => 13,
            Version::V02->value => 22,
            Version::V03->value => 34,
            Version::V04->value => 48,
            Version::V05->value => 62,
            Version::V06->value => 76,
            Version::V07->value => 88,
            Version::V08->value => 110,
            Version::V09->value => 132,
            Version::V10->value => 154,
            Version::V11->value => 180,
            Version::V12->value => 206,
            Version::V13->value => 244,
            Version::V14->value => 261,
            Version::V15->value => 295,
            Version::V16->value => 325,
            Version::V17->value => 367,
            Version::V18->value => 397,
            Version::V19->value => 445,
            Version::V20->value => 485,
            Version::V21->value => 512,
            Version::V22->value => 568,
            Version::V23->value => 614,
            Version::V24->value => 664,
            Version::V25->value => 718,
            Version::V26->value => 754,
            Version::V27->value => 808,
            Version::V28->value => 871,
            Version::V29->value => 911,
            Version::V30->value => 985,
            Version::V31->value => 1033,
            Version::V32->value => 1115,
            Version::V33->value => 1171,
            Version::V34->value => 1231,
            Version::V35->value => 1286,
            Version::V36->value => 1354,
            Version::V37->value => 1426,
            Version::V38->value => 1502,
            Version::V39->value => 1582,
            Version::V40->value => 1666,
        ][$this->version->value];
    }
}
