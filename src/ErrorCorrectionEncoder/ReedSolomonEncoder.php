<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder;

use Monolog\Logger;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Exception\OutOfRangeException;
use ThePhpGuild\QrCode\Exception\VariableNotSetException;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class ReedSolomonEncoder
{
    private ?ErrorCorrectionLevel $errorCorrectionLevel = null;
    private ?Version $version = null;

    public function __construct(
        private readonly NumECCodewordsCalculator $numECCodewordsCalculator,
        private readonly GeneratorPolynomialCreator $generatorPolynomialCreator,
        private readonly RemainderCalculator $remainderCalculator,
        private readonly IOLoggerInterface $logger
    )
    {
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
        $this->logger->info('Calculate Num EC Codewords');

        return $this->numECCodewordsCalculator
            ->setVersion($this->version)
            ->setErrorCorrectionLevel($this->errorCorrectionLevel)
            ->calculate();
    }

    /**
     * @throws OutOfRangeException
     */
    private function createGeneratorPolynomial(int $numECCodewords): array
    {
        $this->logger->info('Create Generator Polynomial');

        return $this->generatorPolynomialCreator->create($numECCodewords);
    }

    /**
     * @throws OutOfRangeException
     */
    private function calculateRemainder(array $data, array $generator): array
    {
        $this->logger->info('Calculate Remainder');

        return $this->remainderCalculator->calculate($data, $generator);
    }
}
