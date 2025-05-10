<?php

namespace ThePhpGuild\QrCode\Polynomial;

interface PolynomialInterface
{
    public function __toString(): string;

    public function getDegree(): int;

    public function getCoefficients(): array;

    public function getCoefficient(int $power): int|float|null;

    public function getDominantCoefficient(): int|float|null;

    public function setCoefficient(int $power, int|float $coefficient): self;
}
