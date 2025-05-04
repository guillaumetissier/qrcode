<?php

namespace ThePhpGuild\QrCode\Step3ErrorCorrectionCoder;

use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Factory as GeneratorPolynomialFactory;
use ThePhpGuild\QrCode\Exception\VariableNotSetException;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Polynomial;

class Step3ErrorCorrectionCoder
{
    private ?ErrorCorrectionLevel $errorCorrectionLevel = null;

    private ?Version $version = null;

    public function __construct(
        private readonly NumECCodewordsCalculator $numECCodewordsCalculator,
        private readonly GeneratorPolynomialFactory $generatorPolynomialFactory,
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
     * @throws VariableNotSetException
     */
    public function addErrorCorrection(array $data): array
    {
        $numECCodewords = $this->calculateNumECCodewords();
        $generatorPolynomial = $this->createGeneratorPolynomial($numECCodewords);
        $dataWithPadding = array_merge($data, array_fill(0, $numECCodewords, 0));
        $remainder = $this->calculateRemainder($dataWithPadding, $generatorPolynomial);

        return array_merge($data, $remainder);
    }

    /**
     * @throws VariableNotSetException
     */
    private function calculateNumECCodewords(): int
    {
        $this->logger->info('Calculate Num EC Codewords');

        return $this->numECCodewordsCalculator
            ->setVersion($this->version)
            ->setErrorCorrectionLevel($this->errorCorrectionLevel)
            ->calculate();
    }

    private function createGeneratorPolynomial(int $numECCodewords): Polynomial
    {
        $this->logger->info('Create Generator Polynomial');

        return $this->generatorPolynomialFactory->create($numECCodewords);
    }

    private function calculateRemainder(array $data, Polynomial $generatorPolynomial): array
    {
        $this->logger->info('Calculate Remainder');

        return $this->remainderCalculator->calculate($data, $generatorPolynomial);
    }
}
