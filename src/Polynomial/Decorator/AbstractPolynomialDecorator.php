<?php

namespace ThePhpGuild\QrCode\Polynomial\Decorator;

use ThePhpGuild\QrCode\Polynomial\PolynomialInterface;

abstract class AbstractPolynomialDecorator implements PolynomialInterface
{
    public function __construct(protected readonly PolynomialInterface $polynomial)
    {
    }

    abstract public function __toString(): string;

    public function getDegree(): int
    {
        return $this->polynomial->getDegree();
    }

    public function getCoefficients(): array
    {
        return $this->polynomial->getCoefficients();
    }

    public function getCoefficient(int $power): int|float|null
    {
        return $this->polynomial->getCoefficient($power);
    }

    public function getDominantCoefficient(): int|float|null
    {
        return $this->polynomial->getDominantCoefficient();
    }

    public function setCoefficient(int $power, int|float $coefficient): self
    {
        $this->polynomial->setCoefficient($power, $coefficient);

        return $this;
    }
}
