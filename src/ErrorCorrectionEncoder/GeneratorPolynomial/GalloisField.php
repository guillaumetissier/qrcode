<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder\GeneratorPolynomial;

use ThePhpGuild\QrCode\Exception\OutOfRangeException;

class GalloisField
{
    private array $exp = [];
    private array $log = [];
    private int $primitivePolynomial = 0x11d;

    public function __construct() {
        $x = 1;
        for ($i = 0; $i < 256; $i++) {
            $this->exp[$i] = $x;
            $this->log[$x] = $i;
            $x <<= 1;
            if ($x & 0x100) {
                $x ^= $this->primitivePolynomial;
            }
        }

        $this->exp[255] = 1;
        $this->log[0] = -1;

        for ($i = 256; $i < 512; $i++) {
            $this->exp[$i] = $this->exp[$i - 255];
        }
    }

    public function getExp(int $i): int
    {
        return $this->exp[$i];
    }

    /**
     * @throws OutOfRangeException
     */
    public function add(int $a, int $b): int
    {
        OutOfRangeException::ensureWithinRange($a, [0, 255]);
        OutOfRangeException::ensureWithinRange($b, [0, 255]);

        return $a ^ $b;
    }

    /**
     * @throws OutOfRangeException
     */
    public function multiply(int $a, int $b): int
    {
        OutOfRangeException::ensureWithinRange($a, [0, 255]);
        OutOfRangeException::ensureWithinRange($b, [0, 255]);

        if ($a === 0 || $b === 0) {
            return 0;
        }
        $logSum = ($this->log[$a] + $this->log[$b]) % 255;

        return $this->exp[$logSum];
    }
}
