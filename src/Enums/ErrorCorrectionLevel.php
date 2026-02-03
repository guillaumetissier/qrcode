<?php

namespace Guillaumetissier\QrCode\Enums;

enum ErrorCorrectionLevel: string
{
    case LOW = 'L';
    case MEDIUM = 'M';
    case QUARTILE = 'Q';
    case HIGH = 'H';
}
