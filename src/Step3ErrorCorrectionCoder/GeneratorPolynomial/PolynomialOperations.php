<?php

namespace ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial;

class PolynomialOperations
{
    public function __construct(private readonly OperationsInterface $operations)
    {}

    public function add(Polynomial $p1, Polynomial $p2): Polynomial
    {
        $degree = max($p1->getDegree(), $p2->getDegree());
        if ($degree < 0) {
            return new Polynomial();
        }

        $polynomial = new Polynomial($degree);

        for ($power = 0; $power <= $degree; $power++) {
            $polynomial->setCoefficient(
                $power,
                $this->operations->add($p1->getCoefficient($power), $p2->getCoefficient($power))
            );
        }

        return $polynomial;
    }

    public function subtract(Polynomial $p1, Polynomial $p2): Polynomial
    {
        $degree = max($p1->getDegree(), $p2->getDegree());
        if ($degree < 0) {
            return new Polynomial();
        }

        $polynomial = new Polynomial($degree);

        for ($power = 0; $power <= $degree; $power++) {
            $polynomial->setCoefficient(
                $power,
                $this->operations->subtract($p1->getCoefficient($power), $p2->getCoefficient($power))
            );
        }

        return $polynomial;
    }

    public function multiply(Polynomial $multiplicand, Polynomial|int|float $multiplier): Polynomial
    {
        if (is_numeric($multiplier)) {
            return new Polynomial(
                array_map(fn($i) => $multiplier * $i, $multiplicand->getCoefficients()),
                [Polynomial::POWER_ORDER => PowerOrder::LOWEST_POWER_FIRST]
            );
        }

        $degree = $multiplicand->getDegree() + $multiplier->getDegree();
        if ($degree < 0) {
            return new Polynomial();
        }

        $polynomial = new Polynomial($degree);

        for ($i = 0; $i <= $multiplicand->getDegree(); $i++) {
            for ($j = 0; $j <= $multiplier->getDegree(); $j++) {
                $power = $i + $j;
                $polynomial->setCoefficient(
                    $power,
                    $this->operations->add(
                        $polynomial->getCoefficient($power),
                        $this->operations->multiply($multiplicand->getCoefficient($i), $multiplier->getCoefficient($j))
                    )
                );
            }
        }

        return $polynomial;
    }

    public function divide(Polynomial $dividend, Polynomial|int|float $divisor): array|Polynomial
    {
        if (is_numeric($divisor)) {
            if (!$divisor) {
                throw new \DivisionByZeroError('Polynomial division by zero');
            }

            return new Polynomial(
                array_map(fn($i) => $i / $divisor, $dividend->getCoefficients()),
                [Polynomial::POWER_ORDER => PowerOrder::LOWEST_POWER_FIRST]
            );
        }

        if ($dividend->getDegree() < $divisor->getDegree()) {
            throw new \DivisionByZeroError('Polynomial division by a polynomial with greater degree');
        }

        $divisorDegree = $divisor->getDegree();
        $divisorDominantCoefficient = $divisor->getDominantCoefficient();
        $quotient = new Polynomial($dividend->getDegree() - $divisorDegree);
        $remainder = new Polynomial($dividend);

        for ($power = $quotient->getDegree(); $power >= 0; $power--) {
            $quotientCoefficient = $remainder->getDominantCoefficient() / $divisorDominantCoefficient;
            $quotient->setCoefficient($power, $quotientCoefficient);
            $remainder = $this->subtract($dividend, $this->multiply($quotient, $divisor));
        }

        return [$quotient, $remainder];
    }
}