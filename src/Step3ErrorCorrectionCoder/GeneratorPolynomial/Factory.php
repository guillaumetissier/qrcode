<?php

namespace ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial;

use ThePhpGuild\QrCode\Logger\IOLoggerInterface;
use ThePhpGuild\QrCode\Polynomial\Operations\Gf256PolynomialOperations;
use ThePhpGuild\QrCode\Polynomial\Polynomial;

class Factory
{
    public function __construct(
        private readonly Gf256BinomialGenerator    $polynomialGenerator,
        private readonly Gf256PolynomialOperations $operations,
        private readonly IOLoggerInterface         $logger
    )
    {
    }

    public function create(int $numErrorCorrectionCodewords): Polynomial
    {
        $this->logger->input("Num EC Codewords = $numErrorCorrectionCodewords", ['class' => static::class]);

        $polynomial = null;

        foreach ($this->polynomialGenerator->generate($numErrorCorrectionCodewords) as $p) {
            $polynomial = !$polynomial ? $p : $this->operations->multiply($polynomial, $p);
        }

        $this->logger->output("Generator Polynomial = {$polynomial}", ['class' => static::class]);

        return $polynomial;
    }
}
