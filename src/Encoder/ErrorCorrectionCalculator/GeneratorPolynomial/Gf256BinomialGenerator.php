<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\GeneratorPolynomial;

use Guillaumetissier\GaloisFields\GaloisField;
use Guillaumetissier\GaloisFields\Polynomial\PolynomialImmutable;

final class Gf256BinomialGenerator
{
    public static function create(): Gf256BinomialGenerator
    {
        return new Gf256BinomialGenerator(new GaloisField(256));
    }

    private function __construct(private readonly GaloisField $gf256)
    {
    }

    public function generate(int $num): \Generator
    {
        for ($i = 0; $i < $num; $i++) {
            yield PolynomialImmutable::fromCoefficients($this->gf256, [1, $this->gf256->exp($i)]);
        }
    }
}
