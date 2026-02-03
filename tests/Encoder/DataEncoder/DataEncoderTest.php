<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataEncoder;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\BitString\CharCountIndicator;
use Guillaumetissier\QrCode\BitString\CharCountIndicatorInterface;
use Guillaumetissier\QrCode\BitString\ModeIndicatorInterface;
use Guillaumetissier\QrCode\BitString\TerminatorInterface;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter\DataCodewordsCounterInterface;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounterFactoryInterface;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataEncoder;
use Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoder\ModeEncoderInterface;
use Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoderFactoryInterface;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;
use PHPUnit\Framework\TestCase;

class DataEncoderTest extends TestCase
{
    public function testEncode(): void
    {
        $dataEncoder = $this->createDataEncoderWithMocks(
            $this->modeEncoderFactory('11111111111111111111111111111'),
            $this->modeIndicator('1111'),
            $this->charCountIndicator('000000000'),
            $this->terminator('0000'),
            $this->dataCodewordsCounterFactory(16),
            $this->logger(),
        );

        $encodedData = $dataEncoder
            ->withData('dummy data')
            ->withMode(Mode::BYTE)
            ->withVersion(Version::V01)
            ->withErrorCorrectionLevel(ErrorCorrectionLevel::MEDIUM)
            ->encode();

        $this->assertEquals(
            str_replace(
                [' ', '\n'],
                '',
                '11110000 00000111 11111111 11111111 ' .
                '11111111 11000000 11101100 00010001 ' .
                '11101100 00010001 11101100 00010001 ' .
                '11101100 00010001 11101100 00010001'
            ),
            "$encodedData"
        );
    }

    private function createDataEncoderWithMocks(
        ModeEncoderFactoryInterface $modeEncoderFactory,
        ModeIndicatorInterface $modeIndicator,
        CharCountIndicatorInterface $charCountIndicator,
        TerminatorInterface $terminator,
        DataCodewordsCounterFactoryInterface $dataCodewordsCounterFactory,
        ?IOLoggerInterface $logger = null
    ): DataEncoder {
        $reflection = new \ReflectionClass(DataEncoder::class);
        $testInstance = $reflection->newInstanceWithoutConstructor();

        $factoryProperty = $reflection->getProperty('modeEncoderFactory');
        $factoryProperty->setValue($testInstance, $modeEncoderFactory);
        $factoryProperty = $reflection->getProperty('modeIndicator');
        $factoryProperty->setValue($testInstance, $modeIndicator);
        $factoryProperty = $reflection->getProperty('charCountIndicator');
        $factoryProperty->setValue($testInstance, $charCountIndicator);
        $factoryProperty = $reflection->getProperty('terminator');
        $factoryProperty->setValue($testInstance, $terminator);
        $factoryProperty = $reflection->getProperty('dataCodewordsCounterFactory');
        $factoryProperty->setValue($testInstance, $dataCodewordsCounterFactory);
        $loggerProperty = $reflection->getProperty('logger');
        $loggerProperty->setValue($testInstance, null);

        return $testInstance;
    }

    private function modeEncoderFactory(string $encodedData): ModeEncoderFactoryInterface
    {
        $modeEncoderMock = $this->createMock(ModeEncoderInterface::class);
        $modeEncoderMock->method('withData')->willReturnSelf();
        $modeEncoderMock->method('encode')->willReturn(BitString::fromString($encodedData));

        $mock = $this->createMock(ModeEncoderFactoryInterface::class);
        $mock->method('getModeEncoder')->willReturn($modeEncoderMock);

        return $mock;
    }

    private function modeIndicator(string $modeIndicator): ModeIndicatorInterface
    {
        $bitStringMock = $this->createMock(BitStringInterface::class);
        $bitStringMock->method('toString')->willReturn($modeIndicator);

        $modeIndicatorMock = $this->createMock(ModeIndicatorInterface::class);
        $modeIndicatorMock->method('withMode')->willReturnSelf();
        $modeIndicatorMock->method('bitString')->willReturn($bitStringMock);

        return $modeIndicatorMock;
    }

    private function charCountIndicator(string $cci): CharCountIndicatorInterface
    {
        $bitStringMock = $this->createMock(BitStringInterface::class);
        $bitStringMock->method('toString')->willReturn($cci);

        $cciMock = $this->createMock(CharCountIndicatorInterface::class);
        $cciMock->method('withMode')->willReturnSelf();
        $cciMock->method('withVersion')->willReturnSelf();
        $cciMock->method('withCharCount')->willReturnSelf();
        $cciMock->method('bitString')->willReturn($bitStringMock);

        return $cciMock;
    }

    private function terminator(string $terminator): TerminatorInterface
    {
        $bitStringMock = $this->createMock(BitStringInterface::class);
        $bitStringMock->method('toString')->willReturn($terminator);

        $terminatorMock = $this->createMock(TerminatorInterface::class);
        $terminatorMock->method('bitString')->willReturn($bitStringMock);

        return $terminatorMock;
    }

    private function dataCodewordsCounterFactory(int $count): DataCodewordsCounterFactoryInterface
    {
        $counterMock = $this->createMock(DataCodewordsCounterInterface::class);
        $counterMock->method('withVersion')->willReturnSelf();
        $counterMock->method('count')->willReturn($count);

        $factoryMock = $this->createMock(DataCodewordsCounterFactoryInterface::class);
        $factoryMock->method('getDataCodewordsCounter')->willReturn($counterMock);

        return $factoryMock;
    }

    private function logger(): IOLoggerInterface
    {
        return $this->createMock(IOLoggerInterface::class);
    }
}
