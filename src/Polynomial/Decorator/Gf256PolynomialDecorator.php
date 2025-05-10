<?php

namespace ThePhpGuild\QrCode\Polynomial\Decorator;

use ThePhpGuild\QrCode\Polynomial\PolynomialInterface;
use ThePhpGuild\QrCode\Scalar\Gf256;

class Gf256PolynomialDecorator extends AbstractPolynomialDecorator
{
    public function __construct(private readonly Gf256 $gf256, PolynomialInterface $polynomial)
    {
        parent::__construct($polynomial);
    }

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
