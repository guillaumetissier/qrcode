<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Exception\OutOfRangeException;
use ThePhpGuild\QrCode\Exception\VariableNotSetException;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

class ReedSolomonEncoder
{
    private ?ErrorCorrectionLevel $errorCorrectionLevel = null;
    private ?Version $version = null;

    public function __construct(
        private readonly GalloisField $galloisField,
        private readonly NumECCodewordsCalculator $numECCodewordsCalculator,
        private readonly LevelFilteredLogger $logger
    )
    {
        $this->logger->setPrefix(self::class);
    }

    public function setErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;

        return $this;
    }

    public function setVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @throws OutOfRangeException
     * @throws VariableNotSetException
     */
    public function addErrorCorrection(array $data): array
    {
        if (!$this->errorCorrectionLevel) {
            throw new VariableNotSetException('errorCorrectionLevel');
        }

        if (!$this->version) {
            throw new VariableNotSetException('version');
        }

        $numECCodewords = $this->calculateNumECCodewords();
        $generatorPolynomial = $this->createGeneratorPolynomial($numECCodewords);
        $dataWithPadding = array_merge($data, array_fill(0, $numECCodewords, 0));
        $remainder = $this->calculateRemainder($dataWithPadding, $generatorPolynomial);

        return array_merge($data, $remainder);
    }

    private function calculateNumECCodewords(): int
    {
        $this->logger->notice('Calculate Num EC Codewords');

        $this->logger->info("Input << Version = {$this->version->value}, ECL = {$this->errorCorrectionLevel->value}");

        $numECCodewords = $this->numECCodewordsCalculator
            ->setVersion($this->version)
            ->setErrorCorrectionLevel($this->errorCorrectionLevel)
            ->calculate();

        $this->logger->info("Output >> Num EC Codewords = $numECCodewords");

        return $numECCodewords;
    }

    /**
     * @throws OutOfRangeException
     */
    private function createGeneratorPolynomial(int $numECCodewords): array
    {
        $this->logger->notice('Create Generator Polynomial');

        $this->logger->info("Input << Num EC Codewords = $numECCodewords");

        $generatorPolynomial = [1];
        for ($i = 0; $i < $numECCodewords; $i++) {
            $generatorPolynomial = $this->multiplyPolynomials(
                $generatorPolynomial,
                [1, $this->galloisField->getExp($i)]
            );
        }

        $this->logger->info('Output >> Generator Polynomial = ' . implode('|', $generatorPolynomial));

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

    /**
     * @throws OutOfRangeException
     */
    private function calculateRemainder($data, $generator): array
    {
        $this->logger->notice('Calculate Remainder');

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

        $remainder = array_slice($data, -($genLength - 1));

        $this->logger->info('Output >> Remainder = ' . implode('|', $remainder));

        return $remainder;
    }
}
