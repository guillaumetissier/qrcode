<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\FinalCodewordsAssembler;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks\CodewordBlocksInterface;
use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks\V01CodewordBlocks;
use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocksFactoryInterface;
use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\FinalCodewordsAssembler;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Version;
use PHPUnit\Framework\TestCase;
use ReflectionException;

class FinalCodewordsAssemblerTest extends TestCase
{
    /**
     * @dataProvider dataAssemble
     */
    public function testAssemble(
        Version $version,
        ErrorCorrectionLevel $ecl,
        CodewordBlocksInterface $codewordBlock,
        string $data,
        string $error,
        string $expected
    ): void {
        $assembler = $this->createFinalCodewordsAssembler($this->codewordBlocksFactoryMock($version, $codewordBlock));
        $actual = $assembler
            ->withVersion($version)
            ->withErrorCorrectionLevel($ecl)
            ->assemble(BitString::fromString($data), BitString::fromString($error));

        $this->assertSame($expected, $actual->toString());
    }

    public static function dataAssemble(): \Generator
    {
        yield [
            Version::V01,
            ErrorCorrectionLevel::LOW,
            new V01CodewordBlocks(),
            str_replace(
                [' ', '\n'],
                '',
                '01010101 01010101 01010101 01010101 01010101 01010101 01010101 01010101 01010101 01010101' .
                '01010101 01010101 01010101 01010101 01010101 01010101 01010101 01010101 01010101'
            ),
            str_replace(
                [' ', '\n'],
                '',
                '11001100 11001100 11001100 11001100 11001100 11001100 11001100'
            ),
            str_replace(
                [' ', '\n'],
                '',
                '01010101 01010101 01010101 01010101 01010101 01010101 01010101 01010101 01010101 01010101' .
                '01010101 01010101 01010101 01010101 01010101 01010101 01010101 01010101 01010101 11001100' .
                '11001100 11001100 11001100 11001100 11001100 11001100'
            ),
        ];
    }

    /**
     * @throws ReflectionException
     */
    private function createFinalCodewordsAssembler(
        CodewordBlocksFactoryInterface $codewordBlocksFactory
    ): FinalCodewordsAssembler {
        $reflection  = new \ReflectionClass(FinalCodewordsAssembler::class);
        $testInstance = $reflection->newInstanceWithoutConstructor();

        $factoryProperty = $reflection->getProperty('factory');
        $factoryProperty->setValue($testInstance, $codewordBlocksFactory);

        $loggerProperty = $reflection->getProperty('logger');
        $loggerProperty->setValue($testInstance, null);

        return $testInstance;
    }

    private function codewordBlocksFactoryMock(
        Version $version,
        CodewordBlocksInterface $codewordBlock
    ): CodewordBlocksFactoryInterface {
        $codewordBlocksFactory = $this->createMock(CodewordBlocksFactoryInterface::class);
        $codewordBlocksFactory->method('getCodewordBlocks')->with($version)->willReturn($codewordBlock);

        return $codewordBlocksFactory;
    }
}
