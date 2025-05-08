<?php

namespace ThePhpGuild\QrCode\Enums;

enum Mode: string
{
    case NUMERIC = "NUMERIC";
    case ALPHANUMERIC = "ALPHANUMERIC";
    case BYTE = "BYTE";
}
