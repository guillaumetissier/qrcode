<?php

namespace ThePhpGuild\QrCode\Matrix\Renderer;

use ThePhpGuild\QrCode\Exception\ImageNotCreatedException;
use ThePhpGuild\QrCode\Exception\UnhandledFileTypeException;
use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Matrix\Renderer\Canvas\CanvasInterface;
use ThePhpGuild\QrCode\Matrix\Renderer\Canvas\Image;
use ThePhpGuild\QrCode\Matrix\Renderer\Canvas\PdfDocument;
use ThePhpGuild\QrCode\Matrix\Renderer\File\FileType;
use ThePhpGuild\QrCode\Matrix\Renderer\Output\OutputInterface;
use ThePhpGuild\QrCode\Matrix\Renderer\Output\OutputOptions;
use ThePhpGuild\QrCode\Matrix\Renderer\Painter\PainterInterface;

class MatrixRenderer implements MatrixRendererInterface
{
    private ?array $matrix = null;
    private ?OutputOptions $outputOptions = null;

    public function __construct(readonly private PainterInterface $matrixPainter)
    {
    }

    public function setMatrix(Matrix|array $matrix): self
    {
        $this->matrix = is_array($matrix) ? $matrix : $matrix->toArray();

        return $this;
    }

    public function setOutputOptions(?OutputOptions $outputOptions): self
    {
        $this->outputOptions = $outputOptions;

        return $this;
    }

    /**
     * @throws ImageNotCreatedException
     * @throws UnhandledFileTypeException
     */
    public function render(): void
    {
        $canvas = $this->createCanvas();
        $this->matrixPainter->paint($canvas, $this->matrix, $this->outputOptions->getScale());
        $canvas->output($this->outputOptions);
    }

    /**
     * @throws ImageNotCreatedException
     * @throws UnhandledFileTypeException
     */
    private function createCanvas(): CanvasInterface&OutputInterface
    {
        if (FileType::PDF === $this->outputOptions->getFileType()) {
            return new PdfDocument();
        }

        $dataSize = count($this->matrix);

        return new Image($dataSize, $dataSize);
    }
}
