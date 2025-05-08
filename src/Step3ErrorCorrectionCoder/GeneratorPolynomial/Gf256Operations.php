<?php

namespace ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial;

class Gf256Operations implements OperationsInterface
{
    private static ?Gf256Operations $instance = null;

    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self(Gf256::getInstance());
        }

        return self::$instance;
    }

    private function __construct(private readonly Gf256 $gf256)
    {}

    private function __clone() {}

    public function add(?int $a, ?int $b): int
    {
        return $a ^ $b;
    }

    public function subtract(?int $a, ?int $b): int
    {
        return $this->add($a, $b);
    }

    public function multiply(?int $a, ?int $b): int
    {
        if (!$a || !$b) {
            return 0;
        }
        $logSum = ($this->gf256->log($a) + $this->gf256->log($b)) % 255;

        return $this->gf256->alphaExp($logSum);
    }

    public function divide(?int $a, ?int $b): int
    {
        return $this->multiply($a, $b);
    }
}
