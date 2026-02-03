<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\GeneratorPolynomial\GeneratorPolynomialFactory;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\GeneratorPolynomial\GeneratorPolynomialFactoryInterface;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\NumECCodewordsCalculator\NumECCodewordsCalculator;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\RemainderCalculator\RemainderCalculator;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculatorInterface;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class ErrorCorrectionCalculator implements ErrorCorrectionCalculatorInterface
{
    private ?ErrorCorrectionLevel $errorCorrectionLevel = null;

    private ?Version $version = null;

    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new ErrorCorrectionCalculator(
            NumECCodewordsCalculator::create($logger),
            GeneratorPolynomialFactory::create($logger),
            RemainderCalculator::create($logger),
            $logger
        );
    }

    private function __construct(
        private readonly NumECCodewordsCalculatorInterface $numECCodewordsCalculator,
        private readonly GeneratorPolynomialFactoryInterface $generatorPolynomialFactory,
        private readonly RemainderCalculatorInterface $remainderCalculator,
        private readonly ?IOLoggerInterface $logger = null,
    ) {
    }

    public function withErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;

        return $this;
    }

    public function withVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @throws MissingInfoException
     */
    public function calculateErrorCorrection(BitString $dataBitString): BitString
    {
        if ($this->errorCorrectionLevel === null) {
            throw MissingInfoException::missingInfo('errorCorrectionLevel', self::class);
        }

        if ($this->version === null) {
            throw MissingInfoException::missingInfo('version', self::class);
        }

        $this->logger?->info('Calculate Num EC Codewords', ['class' => self::class]);

        $numECCodewords = $this->numECCodewordsCalculator
            ->withVersion($this->version)
            ->withErrorCorrectionLevel($this->errorCorrectionLevel)
            ->calculate();

        $this->logger?->info('Create Generator Polynomial', ['class' => self::class]);

        $generatorPolynomial = $this->generatorPolynomialFactory->createGeneratorPolynomial($numECCodewords);

        $this->logger?->info('Calculate Remainder', ['class' => self::class]);

        $remainder = $this->remainderCalculator
            ->withGeneratorPolynomial($generatorPolynomial)
            ->calculate($dataBitString);

        return $dataBitString->append($remainder);
    }
}
