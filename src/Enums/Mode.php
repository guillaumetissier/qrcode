<?php

namespace Guillaumetissier\QrCode\Enums;

enum Mode: string
{
    case NUMERIC = "NUMERIC";
    case ALPHANUMERIC = "ALPHANUMERIC";
    case BYTE = "BYTE";
}
