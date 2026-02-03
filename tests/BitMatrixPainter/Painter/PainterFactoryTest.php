<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixPainter\Painter;

use Generator;
use Guillaumetissier\QrCode\BitMatrixPainter\File\FileType;
use Guillaumetissier\QrCode\BitMatrixPainter\Painter\ImagePainter;
use Guillaumetissier\QrCode\BitMatrixPainter\Painter\PainterFactory;
use Guillaumetissier\QrCode\BitMatrixPainter\Painter\PdfDocumentPainter;
use PHPUnit\Framework\TestCase;

class PainterFactoryTest extends TestCase
{
    /**
     * @param FileType $fileType
     * @param class-string $expected
     * @return void
     * @dataProvider dataCreateCanvas
     */
    public function testCreateCanvas(FileType $fileType, string $expected): void
    {
        $this->assertInstanceOf($expected, PainterFactory::create()->createPainter($fileType));
    }

    public static function dataCreateCanvas(): Generator
    {
        yield [FileType::PDF, PdfDocumentPainter::class];
        yield [FileType::GIF, ImagePainter::class];
        yield [FileType::JPG, ImagePainter::class];
        yield [FileType::PNG, ImagePainter::class];
    }
}
