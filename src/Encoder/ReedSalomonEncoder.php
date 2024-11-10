<?php

namespace ThePhpGuild\QrCode\Encoder;

use ThePhpGuild\Qrcode\Encoder\ReedSalomonEncoder\GalloisField;

class ReedSolomonEncoder
{
    public function __construct(private readonly GalloisField $galloisField)
    {
    }

    public function encode($data, $numECCodewords): array
    {
        $genPoly = $this->generateGeneratorPolynomial($numECCodewords);
        $msgPoly = array_merge($data, array_fill(0, $numECCodewords, 0));

        foreach ($data as $i => $coeff) {
            $factor = $msgPoly[$i];
            if ($factor !== 0) {
                foreach ($genPoly as $j => $genCoefficient) {
                    $msgPoly[$i + $j] ^= $this->galloisField->multiply($genCoefficient, $factor);
                }
            }
        }

        return array_slice($msgPoly, -$numECCodewords);
    }

    private function generateGeneratorPolynomial($degree): array
    {
        $generatorPolynomial = [1];
        for ($i = 0; $i < $degree; $i++) {
            $generatorPolynomial = $this->polynomialMultiply(
                $generatorPolynomial,
                [1, $this->galloisField->getExp($i)]
            );
        }
        return $generatorPolynomial;
    }

    private function polynomialMultiply(array $p, array $q): array
    {
        $result = array_fill(0, count($p) + count($q) - 1, 0);
        foreach ($p as $i => $pv) {
            foreach ($q as $j => $qv) {
                $result[$i + $j] ^= $this->galloisField->multiply($pv, $qv);
            }
        }
        return $result;
    }
}
