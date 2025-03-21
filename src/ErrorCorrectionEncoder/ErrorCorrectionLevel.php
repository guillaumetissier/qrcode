<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder;

enum ErrorCorrectionLevel: string
{
    case LOW = 'L';
    case MEDIUM = 'M';
    case QUARTILE = 'Q';
    case HIGH = 'H';
}
