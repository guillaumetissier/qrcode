<?php

namespace ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial;

class Gf256Operations implements OperationsInterface
{
    public function __construct(private readonly Gf256 $gf256)
    {}

    public function add(?int $a, ?int $b): int
    {
        return $a ^ $b;
    }

    public function subtract(?int $a, ?int $b): int
    {
        return $a ^ $b;
    }

    public function multiply(?int $a, ?int $b): int
    {
        if (!$a || !$b) {
            return 0;
        }
        $logSum = ($this->gf256->log($a) + $this->gf256->log($b)) % 255;

        return $this->gf256->alphaExp($logSum);
    }
}
