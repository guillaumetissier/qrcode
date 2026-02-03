<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixPainter\Canvas;

use Guillaumetissier\QrCode\Commands\Output\OutputOptionsInterface;
use Guillaumetissier\QrCode\Exception\ColorException;
use TCPDF;

final class PdfDocument implements CanvasInterface
{
    private TCPDF $pdf;

    /**
     * @var array<string, array{int, int, int}>
     */
    private array $palette = [];

    public static function createA4(): self
    {
        return new PdfDocument(210, 297, 'mm');
    }

    public static function createLetter(): self
    {
        return new PdfDocument(216, 279, 'mm');
    }

    public static function createLegal(): self
    {
        return new PdfDocument(216, 356, 'mm');
    }

    public static function createLedger(): self
    {
        return new PdfDocument(279, 432, 'mm');
    }

    private function __construct(
        private readonly int $width,
        private readonly int $height,
        private readonly string $unit,
    ) {
        $this->pdf = new TCPDF('P', $this->unit, [$this->width, $this->height], true, 'UTF-8', false);

        // Configure PDF
        $this->pdf->SetCreator('QR Code Generator');
        $this->pdf->SetAuthor('QR Code Generator');
        $this->pdf->SetTitle('QR Code');
        $this->pdf->SetSubject('QR Code');

        // Remove default header/footer
        $this->pdf->setPrintHeader(false);
        $this->pdf->setPrintFooter(false);

        // Set margins to 0 for precise positioning
        $this->pdf->SetMargins(0, 0, 0);
        $this->pdf->SetAutoPageBreak(false, 0);

        $this->pdf->AddPage();

        // Initialize default colors
        $this->addColorToPalette('black', 0, 0, 0);
        $this->addColorToPalette('white', 255, 255, 255);
    }

    private function __clone()
    {
    }

    public function addColorToPalette(string $colorName, int $red, int $green, int $blue): self
    {
        $this->palette[$colorName] = [$red, $green, $blue];

        return $this;
    }

    /**
     * @throws ColorException
     */
    public function paintRectangle(string $colorName, int $x1, int $y1, int $x2, int $y2): bool
    {
        if (!isset($this->palette[$colorName])) {
            throw ColorException::colorNotFound($colorName);
        }

        // Calculate width and height from coordinates
        $width = $x2 - $x1;
        $height = $y2 - $y1;

        // Set fill color and draw filled rectangle
        $this->pdf->SetFillColorArray($this->palette[$colorName]);
        $this->pdf->Rect($x1, $y1, $width, $height, 'F');

        return true;
    }

    public function output(OutputOptionsInterface $options): bool
    {
        if (null !== ($contentType = $options->contentType())) {
            header("Content-Type: ${contentType}");
        }

        // Determine output mode:
        // 'F' = save to file
        // 'I' = send to browser inline
        // 'D' = force download
        $mode = $options->filename() ? 'F' : 'I';
        $filename = $options->filename() ?? 'qrcode.pdf';

        $result = $this->pdf->Output($filename, $mode);

        // Output() returns the PDF content as string or true/false depending on mode
        return $result !== false;
    }

    public function getPdf(): TCPDF
    {
        return $this->pdf;
    }
}
