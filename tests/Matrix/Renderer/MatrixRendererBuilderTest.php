<?php

namespace Tests\Matrix\Renderer;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Exception\UnhandledFileTypeException;
use ThePhpGuild\QrCode\Matrix\Renderer\File\FileType;
use ThePhpGuild\QrCode\Matrix\Renderer\MatrixRenderer;
use ThePhpGuild\QrCode\Matrix\Renderer\MatrixRendererBuilder;
use ThePhpGuild\QrCode\Matrix\Renderer\Output\OutputOptions;
use ThePhpGuild\QrCode\Matrix\Renderer\Painter\ImagePainter;
use ThePhpGuild\QrCode\Matrix\Renderer\Painter\PdfDocumentPainter;

class MatrixRendererBuilderTest extends TestCase
{
    private MatrixRendererBuilder $builder;

    protected function setUp(): void
    {
        $this->builder = new MatrixRendererBuilder();
    }

    /**
     * @throws UnhandledFileTypeException
     * @throws Exception
     * @dataProvider provideDataForBuildRenderer
     */
    public function testBuildRenderer(FileType $fileType, string $expectedPainterClass): void
    {
        $outputOptions = $this->createMock(OutputOptions::class);
        $outputOptions->method('getFileType')->willReturn($fileType);
        $renderer = $this->builder->buildRenderer($outputOptions);
        $this->assertInstanceOf(MatrixRenderer::class, $renderer);

        $reflection = new \ReflectionClass($renderer);
        $property = $reflection->getProperty('matrixPainter');
        $this->assertInstanceOf($expectedPainterClass, $property->getValue($renderer));
    }

    public static function provideDataForBuildRenderer(): array
    {
        return [
            [FileType::GIF, ImagePainter::class],
            [FileType::JPG, ImagePainter::class],
            [FileType::PNG, ImagePainter::class],
            [FileType::PDF, PdfDocumentPainter::class],
        ];
    }
}
