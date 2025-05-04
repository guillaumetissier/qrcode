<?php

namespace ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial;

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
}
