<?php

namespace ThePhpGuild\QrCode\Polynomial\Operations;

use ThePhpGuild\QrCode\Polynomial\Polynomial;

interface PolynomialOperationsInterface
{
    public function add(Polynomial $p1, Polynomial $p2): Polynomial;

    public function subtract(Polynomial $p1, Polynomial $p2): Polynomial;

    public function multiply(Polynomial $multiplicand, Polynomial|int|float $multiplier): Polynomial;

    public function divide(Polynomial $dividend, Polynomial|int|float $divisor): array|Polynomial;
}
