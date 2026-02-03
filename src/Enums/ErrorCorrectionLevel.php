<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Enums;

enum ErrorCorrectionLevel: string
{
    case LOW = 'L';
    case MEDIUM = 'M';
    case QUARTILE = 'Q';
    case HIGH = 'H';
}
