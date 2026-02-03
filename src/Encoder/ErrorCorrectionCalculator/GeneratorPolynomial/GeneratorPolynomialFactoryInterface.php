<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\GeneratorPolynomial;

use Guillaumetissier\GaloisFields\Polynomial\PolynomialImmutable;

interface GeneratorPolynomialFactoryInterface
{
    public function createGeneratorPolynomial(int $numErrorCorrectionCodewords): PolynomialImmutable;
}
