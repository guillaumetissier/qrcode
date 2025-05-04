<?php

namespace ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial;

enum PowerOrder: int
{
    case HIGHEST_POWER_FIRST = 1;
    case LOWEST_POWER_FIRST = 2;
}
