<?php

namespace Tests\Matrix\Renderer\Output;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Exception\InvalidOutputOptions;
use ThePhpGuild\QrCode\Matrix\Renderer\File\FileType;
use ThePhpGuild\QrCode\Matrix\Renderer\Output\OutputOptions;

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
            [[OutputOptions::FILETYPE => FileType::PDF, 'foo' => 'bar']],
            [[OutputOptions::FILENAME => 'some/filename.pdf', 'foo' => 'bar']],
            [[OutputOptions::FILETYPE => FileType::PDF, OutputOptions::FILENAME => 'some/filename.pdf']],
        ];
    }

    /**
     * @throws InvalidOutputOptions
     */
    public function testThrowInvalidOutputOptions(): void
    {
        $this->expectException(InvalidOutputOptions::class);
        $outputOptions = new OutputOptions(['foo' => 'bar', OutputOptions::QUALITY => 75, OutputOptions::SCALE => 7]);
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
            [[OutputOptions::FILENAME => 'some/filename.pdf', 'foo' => 'bar'], null],
            [[OutputOptions::FILETYPE => FileType::GIF, 'foo' => 'bar'], 'image/gif'],
            [[OutputOptions::FILETYPE => FileType::JPG, 'foo' => 'bar'], 'image/jpeg'],
            [[OutputOptions::FILETYPE => FileType::PNG, 'foo' => 'bar'], 'image/png'],
            [[OutputOptions::FILETYPE => FileType::PDF, 'foo' => 'bar'], 'application/pdf'],
            [[OutputOptions::FILETYPE => FileType::PDF, OutputOptions::FILENAME => 'some/filename.jpeg'], null],
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
                [OutputOptions::FILENAME => 'some/filename.pdf', 'foo' => 'bar'],
                'some/filename.pdf',
                FileType::PDF,
                80,
                10
            ],
            [
                [OutputOptions::FILETYPE => FileType::GIF, OutputOptions::SCALE => 2, 'foo' => 'bar'],
                null,
                FileType::GIF,
                80,
                2
            ],
            [
                [OutputOptions::FILETYPE => FileType::JPG, OutputOptions::QUALITY => 70, 'foo' => 'bar'],
                null,
                FileType::JPG,
                70,
                10
            ],
            [
                [
                    OutputOptions::FILETYPE => FileType::PNG,
                    OutputOptions::FILENAME => 'some/filename.pdf',
                    'foo' => 'bar'
                ],
                'some/filename.pdf',
                FileType::PDF,
                80,
                10
            ],
        ];
    }
}
