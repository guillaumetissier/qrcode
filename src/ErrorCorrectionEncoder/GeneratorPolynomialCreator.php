<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder;

use ThePhpGuild\QrCode\Exception\OutOfRangeException;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

class GeneratorPolynomialCreator
{
    public function __construct(
        private readonly GalloisField $galloisField,
        private readonly LevelFilteredLogger $logger
    )
    {
        $this->logger->setPrefix(self::class);
    }

    /**
     * @throws OutOfRangeException
     */
    public function create($numECCodewords): array
    {
        $this->logger->input("Num EC Codewords = $numECCodewords");

        $generatorPolynomial = [1];
        for ($i = 0; $i < $numECCodewords; $i++) {
            $generatorPolynomial = $this->multiplyPolynomials(
                $generatorPolynomial,
                [1, $this->galloisField->getExp($i)]
            );
        }

        $this->logger->output("Generator Polynomial = " . json_encode($generatorPolynomial));

        return $generatorPolynomial;
    }

    /**
     * @throws OutOfRangeException
     */
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
}
