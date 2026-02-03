<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\ErrorCorrectionCalculator;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\GeneratorPolynomial\GeneratorPolynomialFactoryInterface;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\NumECCodewordsCalculatorInterface;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\RemainderCalculatorInterface;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;
use Guillaumetissier\QrCode\Tests\Logger\LoggerTestCase;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\ErrorCorrectionCalculator;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\VariableNotSetException;

class ErrorCorrectionCalculatorTest extends LoggerTestCase
{
    private ErrorCorrectionCalculator $encoder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->encoder = $this->createDataEncoderWithMocks(
            $this->numECCodewordsCalculator(),
            $this->generatorPolynomialFactory(),
            $this->remainderCalculator(),
            $this->logger
        );
    }

    public function testThrowsExceptionIfErrorCorrectionLevelNotSet(): void
    {
        $this->expectException(MissingInfoException::class);
        $this->encoder
            ->withVersion(Version::V14)
            ->calculateErrorCorrection(new BitString('10101010001010100101001'));
    }

    public function testThrowsExceptionIfVersionNotSet(): void
    {
        $this->expectException(MissingInfoException::class);
        $this->encoder
            ->withErrorCorrectionLevel(ErrorCorrectionLevel::MEDIUM)
            ->calculateErrorCorrection(new BitString('10101010001010100101001'));
    }

    private function createDataEncoderWithMocks(
        NumECCodewordsCalculatorInterface $numECCodewordsCalculator,
        GeneratorPolynomialFactoryInterface $generatorPolynomialFactory,
        RemainderCalculatorInterface $remainderCalculator,
        ?IOLoggerInterface $logger = null
    ): ErrorCorrectionCalculator {

        $reflection = new \ReflectionClass(ErrorCorrectionCalculator::class);
        $testInstance = $reflection->newInstanceWithoutConstructor();
        $numECCodewordsCalculatorProperty = $reflection->getProperty('numECCodewordsCalculator');
        $numECCodewordsCalculatorProperty->setValue($testInstance, $numECCodewordsCalculator);
        $generatorPolynomialFactoryProperty = $reflection->getProperty('generatorPolynomialFactory');
        $generatorPolynomialFactoryProperty->setValue($testInstance, $generatorPolynomialFactory);
        $remainderCalculatorProperty = $reflection->getProperty('remainderCalculator');
        $remainderCalculatorProperty->setValue($testInstance, $remainderCalculator);
        $loggerProperty = $reflection->getProperty('logger');
        $loggerProperty->setValue($testInstance, $logger);

        return $testInstance;
    }

    private function numECCodewordsCalculator(): NumECCodewordsCalculatorInterface
    {
        $mock = $this->createMock(NumECCodewordsCalculatorInterface::class);

        return $mock;
    }

    private function generatorPolynomialFactory(): GeneratorPolynomialFactoryInterface
    {
        $mock = $this->createMock(GeneratorPolynomialFactoryInterface::class);

        return $mock;
    }

    private function remainderCalculator(): RemainderCalculatorInterface
    {
        $mock = $this->createMock(RemainderCalculatorInterface::class);

        return $mock;
    }
}
