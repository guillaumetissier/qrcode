<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\QrCode\Common\ErrorCorrectionLevelDependentTrait;
use Guillaumetissier\QrCode\Common\VersionDependentTrait;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\GeneratorPolynomial\GeneratorPolynomialFactory;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\GeneratorPolynomial\GeneratorPolynomialFactoryInterface;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\NumECCodewordsCalculator\NumECCodewordsCalculator;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\RemainderCalculator\RemainderCalculator;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculatorInterface;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class ErrorCorrectionCalculator implements ErrorCorrectionCalculatorInterface
{
    use ErrorCorrectionLevelDependentTrait;
    use VersionDependentTrait;

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

    /**
     * @throws MissingInfoException
     */
    public function calculateErrorCorrection(BitString $dataBitString): BitString
    {
        $errorCorrectionLevel = $this->errorCorrectionLevel();
        $version = $this->version();

        $this->logger?->info('Calculate Num EC Codewords', ['class' => self::class]);

        $numECCodewords = $this->numECCodewordsCalculator
            ->withErrorCorrectionLevel($errorCorrectionLevel)
            ->withVersion($version)
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
