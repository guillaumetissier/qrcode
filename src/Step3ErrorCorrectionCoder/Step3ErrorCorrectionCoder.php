<?php

namespace ThePhpGuild\QrCode\Step3ErrorCorrectionCoder;

use ThePhpGuild\QrCode\BitsString\DataBits;
use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Enums\NumeralSystem;
use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Exception\VariableNotSetException;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Factory as GeneratorPolynomialFactory;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Gf256PolynomialOperations;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Polynomial;

class Step3ErrorCorrectionCoder
{
    private ?ErrorCorrectionLevel $errorCorrectionLevel = null;

    private ?Version $version = null;

    public function __construct(
        private readonly NumECCodewordsCalculator $numECCodewordsCalculator,
        private readonly GeneratorPolynomialFactory $generatorPolynomialFactory,
        private readonly Gf256PolynomialOperations $gf256PolynomialOperations,
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
    public function addErrorCorrection(DataBits $data): DataBits
    {
        if ($this->errorCorrectionLevel === null || $this->version === null) {
            throw new VariableNotSetException($this->errorCorrectionLevel ? 'errorCorrectionLevel' : 'version');
        }

        $numECCodewords = $this->calculateNumECCodewords();
        $generatorPolynomial = $this->createGeneratorPolynomial($numECCodewords);
        $remainder = $this->calculateRemainder($data, $generatorPolynomial);

        return $data->append($remainder);
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

    private function calculateRemainder(DataBits $data, Polynomial $generatorPolynomial): array
    {
        $this->logger->info('Calculate Remainder');

        return $this->gf256PolynomialOperations->divide(
            new Polynomial($data->toCodewords(NumeralSystem::DECIMAL)),
            $generatorPolynomial
        );
    }
}
