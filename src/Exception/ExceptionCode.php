<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Exception;

enum ExceptionCode: int
{
    case COLOR_NOT_FOUND = 1;
    case DATA_TOO_VOLUMINOUS = 2;
    case IMAGE_NOT_CREATED = 3;
    case INVALID_INPUT = 4;
    case INVALID_OUTPUT_OPTION = 5;
    case MISSING_OPTION = 6;
    case MISSING_INFO = 7;
    case NO_DATA = 8;
    case UNHANDLED_FILE_TYPE = 9;
    case UNKNOWN_MODE = 10;
    case UNKNOWN_VERSION = 11;
}
