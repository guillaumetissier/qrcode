<?php

namespace ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial;

class Gf256BinomialGenerator
{
    public function __construct(private readonly Gf256 $gf256)
    {}

    public function generate($num): \Generator
    {
        for ($i = 0; $i < $num; $i++) {
            yield new Polynomial([1, $this->gf256->alphaExp($i)]);
        }
    }
}
