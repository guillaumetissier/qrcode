<?php

namespace Guillaumetissier\QrCode\Tests\Commands\Output;

use Guillaumetissier\QrCode\BitMatrixPainter\File\FileType;
use Guillaumetissier\QrCode\Commands\Output\OutputOptions;
use Guillaumetissier\QrCode\Exception\InvalidOutputOptionsException;
use PHPUnit\Framework\TestCase;

class OutputOptionsTest extends TestCase
{
    /**
     * @dataProvider provideDataForGetContentType
     */
    public function testGetContentType(array $options, ?string $expectedContentType): void
    {
        $outputOptions = new OutputOptions($options);

        $this->assertEquals($expectedContentType, $outputOptions->contentType());
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
    ): void {
        $outputOptions = new OutputOptions($options);
        $this->assertEquals($expectedFilename, $outputOptions->filename());
        $this->assertEquals($expectedFileType, $outputOptions->fileType());
        $this->assertEquals($expectedQuality, $outputOptions->quality());
        $this->assertEquals($expectedScale, $outputOptions->scale());
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
