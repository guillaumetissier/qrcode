<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\GeneratorPolynomial;

use Guillaumetissier\GaloisFields\Polynomial\PolynomialFormatter;
use Guillaumetissier\GaloisFields\Polynomial\PolynomialImmutable;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class GeneratorPolynomialFactory implements GeneratorPolynomialFactoryInterface
{
    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self(Gf256BinomialGenerator::create(), $logger);
    }

    private function __construct(
        private readonly Gf256BinomialGenerator $polynomialGenerator,
        private readonly ?IOLoggerInterface $logger
    ) {
    }

    public function createGeneratorPolynomial(int $numErrorCorrectionCodewords): PolynomialImmutable
    {
        $this->logger?->input("Num EC Codewords = $numErrorCorrectionCodewords", ['class' => self::class]);

        $polynomial = null;

        foreach ($this->polynomialGenerator->generate($numErrorCorrectionCodewords) as $p) {
            $polynomial = !$polynomial ? $p : $polynomial->mul($p);
        }

        $this->logger?->output(
            "Generator Polynomial = " . PolynomialFormatter::toAlphaString($polynomial),
            ['class' => self::class]
        );

        return $polynomial;
    }
}
