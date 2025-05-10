<?php

namespace ThePhpGuild\QrCode\Scalar\Operations;

class IntegerOperations implements OperationsInterface
{
    public function add(?int $a, ?int $b): int
    {
        return $a + $b;
    }

    public function subtract(?int $a, ?int $b): int
    {
        return $a - $b;
    }

    public function multiply(?int $a, ?int $b): int
    {
        return (!$a || !$b) ? 0 : $a * $b;
    }

    public function divide(?int $a, ?int $b): int
    {
        if (!$b) {
            throw new \DivisionByZeroError('Division by zero');
        }
        return !$a ? 0 : $a / $b;
    }
}
