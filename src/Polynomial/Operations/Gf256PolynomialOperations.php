<?php

namespace ThePhpGuild\QrCode\Polynomial\Operations;

use ThePhpGuild\QrCode\Scalar\Operations\Gf256Operations;

class Gf256PolynomialOperations extends PolynomialOperations
{
    private static ?Gf256PolynomialOperations $instance = null;

    public static function getInstance(): Gf256PolynomialOperations
    {
        if (null === self::$instance) {
            self::$instance = new Gf256PolynomialOperations(Gf256Operations::getInstance());
        }

        return self::$instance;
    }

    private function __construct(Gf256Operations $gf256Operations)
    {
        parent::__construct($gf256Operations);
    }
}
