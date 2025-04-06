<?php

namespace ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial;

use ThePhpGuild\QrCode\Exception\OutOfRangeException;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class GeneratorPolynomialCreator
{
    public function __construct(
        private readonly GalloisField $galloisField,
        private readonly IOLoggerInterface $logger
    )
    {
    }

    /**
     * @throws OutOfRangeException
     */
    public function create(int $numErrorCorrectionCodewords): array
    {
        $this->logger->input("Num EC Codewords = $numErrorCorrectionCodewords", ['class' => static::class]);

        $generatorPolynomial = [1];
        for ($i = 0; $i < $numErrorCorrectionCodewords; $i++) {
            $generatorPolynomial = $this->multiplyPolynomials(
                $generatorPolynomial,
                [1, $this->galloisField->getExp($i)]
            );
        }

        $this->logger->output(
            "Generator Polynomial = " . json_encode($generatorPolynomial),
            ['class' => static::class]
        );

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
