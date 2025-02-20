<?php

namespace Tests\MatrixRenderer\Output;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Exception\InvalidOutputOptions;
use ThePhpGuild\QrCode\MatrixRenderer\File\FileType;
use ThePhpGuild\QrCode\MatrixRenderer\Output\OutputOptions;

class OutputOptionsTest extends TestCase
{
    /**
     * @throws InvalidOutputOptions
     * @dataProvider provideDataForEnsureIsValid
     */
    public function testEnsureIsValid(array $options): void
    {
        $outputOptions = new OutputOptions($options);
        $this->assertTrue($outputOptions->ensureIsValid());
    }

    public static function provideDataForEnsureIsValid(): array
    {
        return [
            [['fileType' => FileType::PDF, 'foo' => 'bar']],
            [['filename' => 'some/filename.pdf', 'foo' => 'bar']],
            [['fileType' => FileType::PDF, 'filename' => 'some/filename.pdf']],
        ];
    }

    /**
     * @throws InvalidOutputOptions
     */
    public function testThrowInvalidOutputOptions(): void
    {
        $this->expectException(InvalidOutputOptions::class);
        $outputOptions = new OutputOptions(['foo' => 'bar', 'quality' => 75, 'scale' => 7]);
        $outputOptions->ensureIsValid();
    }

    /**
     * @dataProvider provideDataForGetContentType
     */
    public function testGetContentType(array $options, ?string $expectedContentType): void
    {
        $outputOptions = new OutputOptions($options);

        $this->assertEquals($expectedContentType, $outputOptions->getContentType());
    }

    public static function provideDataForGetContentType(): array
    {
        return [
            [['filename' => 'some/filename.pdf', 'foo' => 'bar'], null],
            [['fileType' => FileType::GIF, 'foo' => 'bar'], 'image/gif'],
            [['fileType' => FileType::JPG, 'foo' => 'bar'], 'image/jpeg'],
            [['fileType' => FileType::PNG, 'foo' => 'bar'], 'image/png'],
            [['fileType' => FileType::PDF, 'foo' => 'bar'], 'application/pdf'],
            [['fileType' => FileType::PDF, 'filename' => 'some/filename.jpeg'], null],
        ];
    }

    /**
     * @dataProvider provideDataForGetters
     */
    public function testGetters(
        array $options,
        ?string $expectedFilename,
        ?FileType $expectedFileType,
        int $expectedQuality,
        int $expectedScale
    ): void
    {
        $outputOptions = new OutputOptions($options);
        $this->assertEquals($expectedFilename, $outputOptions->getFilename());
        $this->assertEquals($expectedFileType, $outputOptions->getFileType());
        $this->assertEquals($expectedQuality, $outputOptions->getQuality());
        $this->assertEquals($expectedScale, $outputOptions->getScale());
    }

    public static function provideDataForGetters(): array
    {
        return [
            [
                ['filename' => 'some/filename.pdf', 'foo' => 'bar'],
                'some/filename.pdf',
                FileType::PDF,
                80,
                10
            ],
            [
                ['fileType' => FileType::GIF, 'scale' => 2, 'foo' => 'bar'],
                null,
                FileType::GIF,
                80,
                2
            ],
            [
                ['fileType' => FileType::JPG, 'quality' => 70, 'foo' => 'bar'],
                null,
                FileType::JPG,
                70,
                10
            ],
            [
                ['fileType' => FileType::PNG, 'filename' => 'some/filename.pdf', 'foo' => 'bar'],
                'some/filename.pdf',
                FileType::PDF,
                80,
                10
            ],
        ];
    }
}
