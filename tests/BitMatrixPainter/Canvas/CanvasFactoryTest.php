<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixPainter\Canvas;

use Generator;
use Guillaumetissier\QrCode\BitMatrixPainter\Canvas\CanvasFactory;
use Guillaumetissier\QrCode\BitMatrixPainter\Canvas\Image;
use Guillaumetissier\QrCode\BitMatrixPainter\Canvas\PdfDocument;
use Guillaumetissier\QrCode\BitMatrixPainter\File\FileType;
use Guillaumetissier\QrCode\Exception\ImageNotCreatedException;
use PHPUnit\Framework\TestCase;

class CanvasFactoryTest extends TestCase
{
    /**
     * @param FileType $fileType
     * @param class-string $expected
     * @return void
     * @throws ImageNotCreatedException
     * @dataProvider dataCreateCanvas
     */
    public function testCreateCanvas(FileType $fileType, string $expected): void
    {
        $this->assertInstanceOf($expected, CanvasFactory::create()->createCanvas($fileType, 100));
    }

    public static function dataCreateCanvas(): Generator
    {
        yield [FileType::PDF, PdfDocument::class];
        yield [FileType::GIF, Image::class];
        yield [FileType::JPG, Image::class];
        yield [FileType::PNG, Image::class];
    }
}
