<?php

namespace ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial;

class Gf256Polynomial
{
    public function __construct(private readonly Gf256 $gf256, private readonly Polynomial $polynomial)
    {}

    public function __toString(): string
    {
        $display = [];
        $degree = $this->polynomial->getDegree();
        for ($i = 0; $i <= $degree; $i++) {
            $power = $degree - $i;
            $coefficient = $this->polynomial->getCoefficient($power);
            $log = $this->gf256->log($coefficient);
            $display[] = "a^{$log}.x^{$power}";
        }

        return implode(" + ", $display);
    }
}
