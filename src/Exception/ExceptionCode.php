<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Exception;

enum ExceptionCode: int
{
    case COLOR_NOT_FOUND = 1;
    case DATA_TOO_VOLUMINOUS = 2;
    case IMAGE_NOT_CREATED = 3;
    case INVALID_OUTPUT_OPTION = 4;
    case MISSING_OPTION = 5;
    case MISSING_INFO = 6;
    case NO_DATA = 7;
    case UNHANDLED_FILE_TYPE = 8;
    case UNKNOWN_MODE = 9;
    case UNKNOWN_VERSION = 10;
    case WRONG_VALUE = 11;
}
