<?php

namespace ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial;

class Polynomial
{
    const POWER_ORDER = 1;

    private array $coefficients = [];

    public function __construct(array|int|Polynomial $arg = [], array $options = [])
    {
        if (is_array($arg)) {
            $order = $options[self::POWER_ORDER] ?? PowerOrder::HIGHEST_POWER_FIRST;
            $this->coefficients = ($order === PowerOrder::LOWEST_POWER_FIRST) ? $arg : array_reverse($arg);
        } elseif (is_numeric($arg)) {
            $this->coefficients = array_fill(0, $arg + 1, 0);
        } elseif ($arg instanceof Polynomial) {
            $this->coefficients = $arg->getCoefficients();
        }
    }

    public function __toString(): string
    {
        $display = [];
        $degree = $this->getDegree();
        for ($i = 0; $i <= $degree; $i++) {
            $power = $degree - $i;

            if (!$coefficient = $this->coefficients[$power]) {
                continue;
            }

            if (is_int($coefficient)) {
                $display[] = "{$coefficient}.x^{$power}";
            } else {
                $display[] = round($coefficient, 2) . ".x^{$power}";
            }
        }

        return implode(" + ", $display);
    }

    public function getDegree(): int
    {
        return count($this->coefficients) - 1;
    }

    public function getCoefficients(): array
    {
        return $this->coefficients;
    }

    public function getCoefficient(int $power): int|float|null
    {
        return $this->coefficients[$power] ?? null;
    }

    public function getDominantCoefficient(): int|float|null
    {
        for ($i = $this->getDegree(); $i >= 0; $i--) {
            if (!!$this->coefficients[$i]) {
                return $this->coefficients[$i];
            }
        }

        return null;
    }

    public function setCoefficient(int $power, int|float $coefficient): self
    {
        if ($power > $this->getDegree()) {
            for ($i = 0; $i < $power - $this->getDegree(); $i++) {
                $this->coefficients[$i] = 0;
            }
        }
        $this->coefficients[$power] = $coefficient;

        return $this;
    }
}
