<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Common\Helper\BitStringFormatter;
use Guillaumetissier\QrCode\Encoder\DataSplitter\DataBlockInterface;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\GeneratorPolynomial\GeneratorPolynomialFactory;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\GeneratorPolynomial\GeneratorPolynomialFactoryInterface;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\RemainderCalculator\RemainderCalculator;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculatorInterface;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class ErrorCorrectionCalculator implements ErrorCorrectionCalculatorInterface
{
    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new ErrorCorrectionCalculator(
            GeneratorPolynomialFactory::create($logger),
            RemainderCalculator::create($logger),
            $logger
        );
    }

    private function __construct(
        private readonly GeneratorPolynomialFactoryInterface $generatorPolynomialFactory,
        private readonly RemainderCalculatorInterface $remainderCalculator,
        private readonly ?IOLoggerInterface $logger = null,
    ) {
    }

    /**
     * @param DataBlockInterface $dataBlock
     * @return BitStringInterface
     */
    public function calculateErrorCorrection(DataBlockInterface $dataBlock): BitStringInterface
    {
        $this->logger?->input(
            [
                'num' => $dataBlock->numErrorCorrectionCodewords(),
                'dataBlock' => PHP_EOL . BitStringFormatter::format($dataBlock->data()),
            ],
            ['class' => self::class]
        );

        $this->logger?->info('Create Generator Polynomial', ['class' => self::class]);

        $generatorPolynomial = $this->generatorPolynomialFactory
            ->createGeneratorPolynomial($dataBlock->numErrorCorrectionCodewords());

        $this->logger?->info('Calculate Remainder', ['class' => self::class]);

        $remainder = $this->remainderCalculator
            ->withGeneratorPolynomial($generatorPolynomial)
            ->calculate($dataBlock->data());

        $this->logger?->output(
            "Remainder =" . PHP_EOL . BitStringFormatter::format($remainder),
            ['class' => self::class]
        );

        return $remainder;
    }
}
