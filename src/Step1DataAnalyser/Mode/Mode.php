<?php

namespace ThePhpGuild\QrCode\Step1DataAnalyser\Mode;

enum Mode: string
{
    case NUMERIC = "NUMERIC";
    case ALPHANUMERIC = "ALPHANUMERIC";
    case BYTE = "BYTE";
}
