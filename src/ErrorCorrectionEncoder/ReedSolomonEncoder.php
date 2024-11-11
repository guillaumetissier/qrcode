<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class ReedSolomonEncoder
{
    private ?ErrorCorrectionLevel $errorCorrectionLevel = null;
    private ?Version $version = null;

    public function __construct(
        private readonly GalloisField $galloisField,
        private readonly NumECCodewordsCalculator $numECCodewordsCalculator
    )
    {
    }

    public function setErrorCorrectionLevel(?ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;

        return $this;
    }

    public function setVersion(?Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function addErrorCorrection(array $data): array
    {
        $numECCodewords = $this->numECCodewordsCalculator
            ->setVersion($this->version)
            ->setErrorCorrectionLevel($this->errorCorrectionLevel)
            ->calculate();

        $generatorPolynomial = $this->createGeneratorPolynomial($numECCodewords);
        $dataWithPadding = array_merge($data, array_fill(0, $numECCodewords, 0));
        $remainder = $this->calculateRemainder($dataWithPadding, $generatorPolynomial);

        return array_merge($data, $remainder);
    }

    private function createGeneratorPolynomial(int $numECCodewords): array
    {
        $generatorPolynomial = [1];
        for ($i = 0; $i < $numECCodewords; $i++) {
            $generatorPolynomial = $this->multiplyPolynomials(
                $generatorPolynomial,
                [1, $this->galloisField->getExp($i)]
            );
        }
        return $generatorPolynomial;
    }

    private function multiplyPolynomials(array $p1, array $p2): array
    {
        $result = array_fill(0, count($p1) + count($p2) - 1, 0);

        for ($i = 0; $i < count($p1); $i++) {
            for ($j = 0; $j < count($p2); $j++) {
                $result[$i + $j] = $this->galloisField->add(
                    $result[$i + $j],
                    $this->galloisField->multiply($p1[$i], $p2[$j])
                );
            }
        }

        return $result;
    }

    private function calculateRemainder($data, $generator): array
    {
        $dataLength = count($data);
        $genLength = count($generator);

        for ($i = 0; $i < $dataLength - ($genLength - 1); $i++) {
            $coefficient = $data[$i];
            if ($coefficient != 0) {
                for ($j = 0; $j < $genLength; $j++) {
                    $data[$i + $j] = $this->galloisField->add(
                        $data[$i + $j],
                        $this->galloisField->multiply($generator[$j], $coefficient)
                    );
                }
            }
        }

        return array_slice($data, -($genLength - 1));
    }
}
