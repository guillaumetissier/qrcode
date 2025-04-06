<?php

namespace ThePhpGuild\QrCode\Step3ErrorCorrectionCoder;

enum ErrorCorrectionLevel: string
{
    case LOW = 'L';
    case MEDIUM = 'M';
    case QUARTILE = 'Q';
    case HIGH = 'H';
}
