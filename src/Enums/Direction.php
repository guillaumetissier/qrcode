<?php

namespace ThePhpGuild\QrCode\Enums;

enum Direction: int
{
    case UPWARDS = 1;
    case DOWNWARDS = -1;

    public function changeDirection(): Direction
    {
        return ($this === Direction::UPWARDS) ? Direction::DOWNWARDS : Direction::UPWARDS;
    }
}
