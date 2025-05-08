<?php

namespace ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter;

use ThePhpGuild\QrCode\Enums\Version;

class EclHighDataCodewordsCounter extends AbstractDataCodewordsCounter
{
    public function count(): int
    {
        return [
            Version::V01->value => 9,
            Version::V02->value => 16,
            Version::V03->value => 26,
            Version::V04->value => 36,
            Version::V05->value => 46,
            Version::V06->value => 60,
            Version::V07->value => 66,
            Version::V08->value => 86,
            Version::V09->value => 100,
            Version::V10->value => 122,
            Version::V11->value => 140,
            Version::V12->value => 158,
            Version::V13->value => 180,
            Version::V14->value => 197,
            Version::V15->value => 223,
            Version::V16->value => 253,
            Version::V17->value => 283,
            Version::V18->value => 313,
            Version::V19->value => 341,
            Version::V20->value => 385,
            Version::V21->value => 406,
            Version::V22->value => 442,
            Version::V23->value => 464,
            Version::V24->value => 514,
            Version::V25->value => 538,
            Version::V26->value => 596,
            Version::V27->value => 628,
            Version::V28->value => 661,
            Version::V29->value => 701,
            Version::V30->value => 745,
            Version::V31->value => 793,
            Version::V32->value => 845,
            Version::V33->value => 901,
            Version::V34->value => 961,
            Version::V35->value => 986,
            Version::V36->value => 1054,
            Version::V37->value => 1096,
            Version::V38->value => 1142,
            Version::V39->value => 1222,
            Version::V40->value => 1276,
        ][$this->version->value];
    }
}