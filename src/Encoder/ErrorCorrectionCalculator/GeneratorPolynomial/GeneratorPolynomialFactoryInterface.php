<?php

namespace Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\GeneratorPolynomial;

use Guillaumetissier\GaloisFields\Polynomial\PolynomialImmutable;

interface GeneratorPolynomialFactoryInterface
{
    public function createGeneratorPolynomial(int $numErrorCorrectionCodewords): PolynomialImmutable;
}
