<?php

namespace ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial;

class Gf256
{
    private static ?Gf256 $instance = null;
    private array $exp = [];
    private array $log = [];
    private int $primitivePolynomial = 0x11d;

    public static function getInstance(): Gf256
    {
        if (null === self::$instance) {
            self::$instance = new Gf256();
        }
        return self::$instance;
    }

    // consider the 5th element of the GF256, it can be annotated a⁴ or 16
    // 4 will be called the logarithm (log)
    // 16 will be called the exponent (exp)
    private function __construct() {
        $exp = 1;
        for ($rank = 0; $rank < 256; $rank++) {
            $this->exp[$rank] = $exp;
            $this->log[$exp] = $rank;
            $exp <<= 1;
            if ($exp & 0x100) {
                $exp ^= $this->primitivePolynomial;
            }
        }
        $this->log[0] = 255;
        $this->log[1] = 0;
        ksort($this->log);
    }

    public function alphaExp(int $rank): int
    {
        return $this->exp[$rank];
    }

    public function log(int $element): int
    {
        return $this->log[$element];
    }
}