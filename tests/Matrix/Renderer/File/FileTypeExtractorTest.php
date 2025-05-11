<?php

namespace Tests\Matrix\Renderer\File;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Exception\UnhandledFileTypeException;
use ThePhpGuild\QrCode\Matrix\Renderer\File\FileType;
use ThePhpGuild\QrCode\Matrix\Renderer\File\FileTypeExtractor;

class FileTypeExtractorTest extends TestCase
{
    /**
     * @throws UnhandledFileTypeException
     * @dataProvider provideDataToExtract
     */
    public function testExtract(string $filename, FileType $expectedFileType): void
    {
        $this->assertEquals($expectedFileType, FileTypeExtractor::extract($filename));
    }

    public static function provideDataToExtract(): array
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
        FileTypeExtractor::extract('/directory/filename.dummy');
    }
}
