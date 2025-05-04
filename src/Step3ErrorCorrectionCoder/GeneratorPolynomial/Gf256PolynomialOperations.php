<?php

namespace ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial;

class Gf256PolynomialOperations extends PolynomialOperations
{
    public function __construct(Gf256Operations $gf256Operations)
    {
        parent::__construct($gf256Operations);
    }
}
