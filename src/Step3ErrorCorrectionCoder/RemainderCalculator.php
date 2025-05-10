<?php

namespace ThePhpGuild\QrCode\Step3ErrorCorrectionCoder;

use ThePhpGuild\QrCode\Logger\IOLoggerInterface;
use ThePhpGuild\QrCode\Polynomial\Polynomial;
use ThePhpGuild\QrCode\Scalar\Operations\Gf256Operations;

class RemainderCalculator
{
    public function __construct(
        private readonly Gf256Operations $gf256Operations,
        private readonly IOLoggerInterface $logger
    )
    {
    }

    public function calculate(array $data, Polynomial $generatorPolynomial): array
    {
        $this->logger->input("Data " . implode($data), ['class' => static::class]);

        $dataLength = count($data);
        $gpDegree = $generatorPolynomial->getDegree();

        for ($i = 0; $i < $dataLength - $gpDegree; $i++) {
            $coefficient = $data[$i];
            if ($coefficient != 0) {
                for ($j = 0; $j < $gpDegree; $j++) {
                    $data[$i + $j] = $this->gf256Operations->add(
                        $data[$i + $j],
                        $this->gf256Operations->multiply($generatorPolynomial->getCoefficient($j), $coefficient)
                    );
                }
            }
        }

        $remainder = array_slice($data, -1 * $gpDegree);

        $this->logger->output('Remainder = ' . implode('|', $remainder), ['class' => static::class]);

        return $remainder;
    }
}
