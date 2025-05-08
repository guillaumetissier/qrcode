<?php

namespace Tests\Step2DataEncodation;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\BitsString\CharCountIndicator;
use ThePhpGuild\QrCode\BitsString\ModeIndicator;
use ThePhpGuild\QrCode\BitsString\Terminator;
use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Enums\Mode;
use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;
use ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter;
use ThePhpGuild\QrCode\Step2DataEncodation\Encoder\Factory;
use ThePhpGuild\QrCode\Step2DataEncodation\Encoder\EncoderInterface;
use ThePhpGuild\QrCode\Step2DataEncodation\Step2DataEncoder;

class Step2DataEncoderTest extends TestCase
{
    public function testEncode(): void
    {
        $step2DataEncoder = new Step2DataEncoder(
            $this->getEncoderFactory('11111111111111111111111111111'),
            $this->getModeIndicator('1111'),
            $this->getCharCountIndicator('000000000'),
            $this->getTerminator('0000'),
            $this->getDataCodewordsCounter(16),
            $this->getLogger(),
        );
        $encodedData = $step2DataEncoder
            ->setData('dummy data')
            ->setMode(Mode::BYTE)
            ->setVersion(Version::V01)
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::MEDIUM)
            ->encode();
        $this->assertEquals(
            '11110000 00000111 11111111 11111111 '.
            '11111111 11000000 11101100 00010001 '.
            '11101100 00010001 11101100 00010001 '.
            '11101100 00010001 11101100 00010001',
            "$encodedData"
        );
    }

    private function getEncoderFactory(string $encodedData): Factory
    {
        $mock = $this->createMock(Factory::class);
        $mock
            ->method('getEncoder')
            ->willReturn(new class($encodedData) implements EncoderInterface {
                function __construct(private readonly string $encodedData)
                {}
                function setData(string $data): self
                {
                    return $this;
                }
                function encode(): string
                {
                    return $this->encodedData;
                }
            });

        return $mock;
    }

    private function getModeIndicator(string $modeIndicator): ModeIndicator
    {
        $mock = $this->createMock(ModeIndicator::class);
        $mock->method('setMode')->willReturnSelf();
        $mock->method('__toString')->willReturn($modeIndicator);

        return $mock;
    }

    private function getCharCountIndicator(string $cci): CharCountIndicator
    {
        $mock = $this->createMock(CharCountIndicator::class);
        $mock->method('setMode')->willReturnSelf();
        $mock->method('setVersion')->willReturnSelf();
        $mock->method('setCharCount')->willReturnSelf();
        $mock->method('__toString')->willReturn($cci);

        return $mock;
    }

    private function getTerminator(string $terminator): Terminator
    {
        $mock = $this->createMock(Terminator::class);
        $mock->method('__toString')->willReturn($terminator);

        return $mock;
    }

    private function getDataCodewordsCounter(int $count): DataCodewordsCounter
    {
        $mock = $this->createMock(DataCodewordsCounter::class);
        $mock->method('setErrorCorrectionLevel')->willReturnSelf();
        $mock->method('setVersion')->willReturnSelf();
        $mock->method('count')->willReturn($count);

        return $mock;
    }

    private function getLogger(): IOLoggerInterface
    {
        return $this->createMock(IOLoggerInterface::class);
    }
}
