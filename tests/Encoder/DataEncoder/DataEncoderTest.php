<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataEncoder;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\BitString\CharCountIndicatorInterface;
use Guillaumetissier\QrCode\BitString\ModeIndicatorInterface;
use Guillaumetissier\QrCode\BitString\PaddingInterface;
use Guillaumetissier\QrCode\BitString\TerminatorInterface;
use Guillaumetissier\QrCode\Common\Helper\BitStringFormatter;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter\DataCodewordsCounterInterface;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounterFactoryInterface;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataEncoder;
use Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoder\ModeEncoderInterface;
use Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoderFactoryInterface;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;
use PHPUnit\Framework\TestCase;

class DataEncoderTest extends TestCase
{
    public function testCreate(): void
    {
        $this->assertInstanceOf(DataEncoder::class, DataEncoder::create());
    }

    public function testMissingData(): void
    {
        $this->expectException(MissingInfoException::class);
        $this->expectExceptionMessage("Info 'data' missing");

        DataEncoder::create()
            ->withMode(Mode::BYTE)
            ->withVersion(Version::V01)
            ->withErrorCorrectionLevel(ErrorCorrectionLevel::MEDIUM)
            ->encode();
    }

    public function testMissingMode(): void
    {
        $this->expectException(MissingInfoException::class);
        $this->expectExceptionMessage("Info 'mode' missing");

        DataEncoder::create()
            ->withData('dummy data')
            ->withVersion(Version::V01)
            ->withErrorCorrectionLevel(ErrorCorrectionLevel::MEDIUM)
            ->encode();
    }

    public function testMissingVersion(): void
    {
        $this->expectException(MissingInfoException::class);
        $this->expectExceptionMessage("Info 'version' missing");

        DataEncoder::create()
            ->withData('dummy data')
            ->withMode(Mode::BYTE)
            ->withErrorCorrectionLevel(ErrorCorrectionLevel::MEDIUM)
            ->encode();
    }


    public function testMissingErrorCorrectionLevel(): void
    {
        $this->expectException(MissingInfoException::class);
        $this->expectExceptionMessage("Info 'errorCorrectionLevel' missing");

        DataEncoder::create()
            ->withData('dummy data')
            ->withMode(Mode::BYTE)
            ->withVersion(Version::V01)
            ->encode();
    }

    public function testEncode(): void
    {
        $data = 'dummy data';
        $version = Version::V01;
        $mode = Mode::BYTE;
        $totalCodewords = 16;
        $errorCorrectionLevel = ErrorCorrectionLevel::MEDIUM;
        $encodedData = BitStringFormatter::normalize('10101010 10101010 10101010 10101');
        $modeIndicator = '0011';
        $charCountIndicator = '000111000';

        $dataEncoder = $this->createDataEncoderWithMocks(
            $this->dataCodewordsCounterFactory($errorCorrectionLevel, $version, $totalCodewords),
            $this->modeEncoderFactory($data, $encodedData), // 29 bits
            $this->modeIndicator($mode, $modeIndicator), // 4 bits -> 33 bits
            $this->charCountIndicator($mode, $version, strlen($data), $charCountIndicator), // 9 bits -> 42 bits
            $this->terminator(), // 4 bits -> 46 bits
            $this->padding(
                strlen($encodedData . $modeIndicator . $charCountIndicator) + 4 /* terminator */,
                $totalCodewords,
                BitStringFormatter::normalize(
                    '00' .
                    '11101100 00010001 11101100 00010001 11101100' .
                    '00010001 11101100 00010001 11101100 00010001'
                )
            ),
            $this->logger(),
        );

        $encodedData = $dataEncoder
            ->withData($data)
            ->withMode($mode)
            ->withVersion($version)
            ->withErrorCorrectionLevel($errorCorrectionLevel)
            ->encode();

        $this->assertEquals(
            BitStringFormatter::normalize(
                '00110001 11000101 01010101 01010101 ' .
                '01010101 01000000 11101100 00010001 ' .
                '11101100 00010001 11101100 00010001 ' .
                '11101100 00010001 11101100 00010001'
            ),
            "$encodedData"
        );
    }

    private function createDataEncoderWithMocks(
        DataCodewordsCounterFactoryInterface $dataCodewordsCounterFactory,
        ModeEncoderFactoryInterface $modeEncoderFactory,
        ModeIndicatorInterface $modeIndicator,
        CharCountIndicatorInterface $charCountIndicator,
        TerminatorInterface $terminator,
        PaddingInterface $padding,
        ?IOLoggerInterface $logger = null
    ): DataEncoder {
        $reflection = new \ReflectionClass(DataEncoder::class);
        $testInstance = $reflection->newInstanceWithoutConstructor();

        $dataCodewordsCounterFactoryProperty = $reflection->getProperty('dataCodewordsCounterFactory');
        $dataCodewordsCounterFactoryProperty->setValue($testInstance, $dataCodewordsCounterFactory);
        $modeEncoderFactoryProperty = $reflection->getProperty('modeEncoderFactory');
        $modeEncoderFactoryProperty->setValue($testInstance, $modeEncoderFactory);
        $modeIndicatorProperty = $reflection->getProperty('modeIndicator');
        $modeIndicatorProperty->setValue($testInstance, $modeIndicator);
        $charCountIndicatorProperty = $reflection->getProperty('charCountIndicator');
        $charCountIndicatorProperty->setValue($testInstance, $charCountIndicator);
        $terminatorProperty = $reflection->getProperty('terminator');
        $terminatorProperty->setValue($testInstance, $terminator);
        $paddingProperty = $reflection->getProperty('padding');
        $paddingProperty->setValue($testInstance, $padding);
        $loggerProperty = $reflection->getProperty('logger');
        $loggerProperty->setValue($testInstance, $logger);

        return $testInstance;
    }

    private function dataCodewordsCounterFactory(
        ErrorCorrectionLevel $errorCorrectionLevel,
        Version $version,
        int $totalCodewords
    ): DataCodewordsCounterFactoryInterface {
        $counterMock = $this->createMock(DataCodewordsCounterInterface::class);
        $counterMock->method('withVersion')->with($version)->willReturnSelf();
        $counterMock->method('count')->willReturn($totalCodewords);

        $factoryMock = $this->createMock(DataCodewordsCounterFactoryInterface::class);
        $factoryMock->method('getDataCodewordsCounter')->with($errorCorrectionLevel)->willReturn($counterMock);

        return $factoryMock;
    }

    private function modeEncoderFactory(string $data, string $encodedData): ModeEncoderFactoryInterface
    {
        $modeEncoderMock = $this->createMock(ModeEncoderInterface::class);
        $modeEncoderMock->method('withData')->with($data)->willReturnSelf();
        $modeEncoderMock->method('encode')->willReturn(BitString::fromString($encodedData));

        $mock = $this->createMock(ModeEncoderFactoryInterface::class);
        $mock->method('getModeEncoder')->willReturn($modeEncoderMock);

        return $mock;
    }

    private function modeIndicator(Mode $mode, string $modeIndicator): ModeIndicatorInterface
    {
        $bitStringMock = $this->createMock(BitStringInterface::class);
        $bitStringMock->method('toString')->willReturn($modeIndicator);

        $modeIndicatorMock = $this->createMock(ModeIndicatorInterface::class);
        $modeIndicatorMock->method('withMode')->with($mode)->willReturnSelf();
        $modeIndicatorMock->method('bitString')->willReturn($bitStringMock);

        return $modeIndicatorMock;
    }

    private function charCountIndicator(
        Mode $mode,
        Version $version,
        int $charCount,
        string $cci
    ): CharCountIndicatorInterface {
        $bitStringMock = $this->createMock(BitStringInterface::class);
        $bitStringMock->method('toString')->willReturn($cci);

        $cciMock = $this->createMock(CharCountIndicatorInterface::class);
        $cciMock->method('withMode')->with($mode)->willReturnSelf();
        $cciMock->method('withVersion')->with($version)->willReturnSelf();
        $cciMock->method('withCharCount')->with($charCount)->willReturnSelf();
        $cciMock->method('bitString')->willReturn($bitStringMock);

        return $cciMock;
    }

    private function terminator(): TerminatorInterface
    {
        $bitStringMock = $this->createMock(BitStringInterface::class);
        $bitStringMock->method('toString')->willReturn('0000');

        $terminatorMock = $this->createMock(TerminatorInterface::class);
        $terminatorMock->method('bitString')->willReturn($bitStringMock);

        return $terminatorMock;
    }

    private function padding(int $bitCount, int $totalCodewords, string $padding): PaddingInterface
    {
        $bitStringMock = $this->createMock(BitStringInterface::class);
        $bitStringMock->method('toString')->willReturn($padding);

        $paddingMock = $this->createMock(PaddingInterface::class);
        $paddingMock->method('withDataBitCount')->with($bitCount)->willReturnSelf();
        $paddingMock->method('withTotalCodewords')->with($totalCodewords)->willReturnSelf();
        $paddingMock->method('bitString')->willReturn($bitStringMock);

        return $paddingMock;
    }

    private function logger(): IOLoggerInterface
    {
        return $this->createMock(IOLoggerInterface::class);
    }
}
