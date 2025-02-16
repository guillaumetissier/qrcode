<?php

namespace File;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Exception\UnhandledFileTypeException;
use ThePhpGuild\QrCode\File\FileType;
use ThePhpGuild\QrCode\File\FileTypeExtractor;

class FileTypeExtractorTest extends TestCase
{
    private FileTypeExtractor $extractor;

    public function setUp(): void
    {
        $this->extractor = new FileTypeExtractor();
    }

    /**
     * @throws UnhandledFileTypeException
     * @dataProvider dataProviderExtract
     */
    public function testExtract(string $filename, FileType $expectedFileType): void
    {
        $this->assertEquals($expectedFileType, $this->extractor->extract($filename));
    }

    public static function dataProviderExtract(): array
    {
        return [
            ['filename.gif', FileType::GIF],
            ['directory/filename.jpg', FileType::JPG],
            ['/directory/filename.jpeg', FileType::JPG],
            ['./directory/filename.png', FileType::PNG],
            ['../directory/filename.pdf', FileType::PDF],
        ];
    }

    public function testExtractWithInvalidExtension(): void
    {
        $this->expectException(UnhandledFileTypeException::class);
        $this->extractor->extract('/directory/filename.dummy');
    }
}
