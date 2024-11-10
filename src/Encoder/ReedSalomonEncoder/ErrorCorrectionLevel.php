<?php

namespace ThePhpGuild\Qrcode\Encoder\ReedSalomonEncoder;

use ThePhpGuild\QrCode\Exception\UnknownMode;

enum ErrorCorrectionLevel
{
    case LOW;
    case MEDIUM;
    case BYTE;

}
