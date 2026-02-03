<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\GaloisFields\Polynomial\PolynomialInterface;

interface RemainderCalculatorInterface
{
    public function withGeneratorPolynomial(PolynomialInterface $generatorPolynomial): self;

    public function calculate(BitString $dataBitString): BitStringImmutable;
}
