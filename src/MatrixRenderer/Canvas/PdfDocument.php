<?php

namespace ThePhpGuild\QrCode\MatrixRenderer\Canvas;

use TCPDF;
use ThePhpGuild\QrCode\Exception\InvalidOutputOptions;
use ThePhpGuild\QrCode\MatrixRenderer\Output\OutputInterface;
use ThePhpGuild\QrCode\MatrixRenderer\Output\OutputOptions;

class PdfDocument implements CanvasInterface, OutputInterface
{
    private ?TCPDF $pdf = null;
    private array $palette = [];

    public function __construct()
    {
        $this->pdf = new TCPDF();
        $this->pdf->AddPage();
        $this->addColorToPalette('black', 0, 0, 0);
        $this->addColorToPalette('white', 255, 255, 255);
    }

    public function addColorToPalette(string $colorName, int $red, int $green, int $blue): self
    {
        $this->palette[$colorName] = [$red, $green, $blue];

        return $this;
    }

    public function paintRectangle(string $colorName, int $x1, int $y1, int $x2, int $y2): bool
    {
        $this->pdf->Rect($x1, $y1, $x2, $y2, 'F', [], $this->palette[$colorName]);

        return true;
    }

    /**
     * @throws InvalidOutputOptions
     */
    public function output(OutputOptions $options): bool
    {
        $options->ensureIsValid();

        if (null !== ($contentType = $options->getContentType())) {
            header("Content-Type: ${contentType}");
        }

        return !!$this->pdf->Output($options->getFilename(), $options->getFilename() ? 'I' : 'F');
    }
}
