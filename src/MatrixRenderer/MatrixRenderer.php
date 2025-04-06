<?php

namespace ThePhpGuild\QrCode\MatrixRenderer;

use ThePhpGuild\QrCode\Exception\ImageNotCreatedException;
use ThePhpGuild\QrCode\Exception\UnhandledFileTypeException;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\QrMatrix;
use ThePhpGuild\QrCode\MatrixRenderer\File\FileType;
use ThePhpGuild\QrCode\MatrixRenderer\Output\OutputInterface;
use ThePhpGuild\QrCode\MatrixRenderer\Canvas\Image;
use ThePhpGuild\QrCode\MatrixRenderer\Canvas\CanvasInterface;
use ThePhpGuild\QrCode\MatrixRenderer\Canvas\PdfDocument;
use ThePhpGuild\QrCode\MatrixRenderer\Painter\PainterInterface;
use ThePhpGuild\QrCode\MatrixRenderer\Output\OutputOptions;

class MatrixRenderer implements MatrixRendererInterface
{
    private ?array $matrix = null;
    private ?OutputOptions $outputOptions = null;

    public function __construct(readonly private PainterInterface $matrixPainter)
    {
    }

    public function setMatrix(QrMatrix|array $matrix): self
    {
        $this->matrix = is_array($matrix) ? $matrix : $matrix->getMatrix();

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
