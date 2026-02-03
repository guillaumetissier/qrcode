<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\RemainderCalculator;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\GaloisFields\GaloisField;
use Guillaumetissier\GaloisFields\Polynomial\PolynomialConverter;
use Guillaumetissier\GaloisFields\Polynomial\PolynomialFormatter;
use Guillaumetissier\GaloisFields\Polynomial\PolynomialInterface;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\RemainderCalculatorInterface;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class RemainderCalculator implements RemainderCalculatorInterface
{
    private ?PolynomialInterface $generatorPolynomial = null;

    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new RemainderCalculator(new PolynomialConverter(new GaloisField(256)), $logger);
    }

    private function __construct(
        private readonly PolynomialConverter $polynomialConverter,
        private readonly ?IOLoggerInterface $logger = null
    ) {
    }

    public function withGeneratorPolynomial(PolynomialInterface $generatorPolynomial): self
    {
        $this->generatorPolynomial = $generatorPolynomial;

        return $this;
    }

    public function calculate(BitString $dataBitString): BitStringImmutable
    {
        if ($this->generatorPolynomial === null) {
            throw MissingInfoException::missingInfo('generatorPolynomial', self::class);
        }

        $dataPolynomial = $this->polynomialConverter->fromBitString($dataBitString);
        $remainder = $dataPolynomial->mod($this->generatorPolynomial);

        $this->logger?->output('Remainder=' . PolynomialFormatter::toAlphaString($remainder), ['class' => self::class]);

        return $this->polynomialConverter->toBitString($remainder);
    }
}
