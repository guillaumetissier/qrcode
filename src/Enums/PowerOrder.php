<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Enums;

enum PowerOrder: int
{
    case HIGHEST_POWER_FIRST = 1;
    case LOWEST_POWER_FIRST = 2;
}
