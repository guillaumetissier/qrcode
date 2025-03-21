<?php

namespace ThePhpGuild\QrCode\DataEncoder\Mode;

enum Mode: string
{
    case NUMERIC = "NUMERIC";
    case ALPHANUMERIC = "ALPHANUMERIC";
    case BYTE = "BYTE";
}
