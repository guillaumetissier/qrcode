<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Enums;

enum Mode: string
{
    case NUMERIC = "NUMERIC";
    case ALPHANUMERIC = "ALPHANUMERIC";
    case BYTE = "BYTE";
}
