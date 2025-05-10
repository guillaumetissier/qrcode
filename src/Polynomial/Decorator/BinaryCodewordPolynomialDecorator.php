<?php

namespace ThePhpGuild\QrCode\Polynomial\Decorator;

class BinaryCodewordPolynomialDecorator extends AbstractPolynomialDecorator
{
    public function __toString(): string
    {
        $display = [];
        $degree = $this->polynomial->getDegree();
        for ($i = 0; $i <= $degree; $i++) {
            $power = $degree - $i;
            $binary = sprintf('%08b', $this->polynomial->getCoefficient($power));
            $display[] = "{$binary}.x^{$power}";
        }

        return implode(" + ", $display);
    }
}
