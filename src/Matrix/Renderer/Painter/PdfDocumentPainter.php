<?php

namespace ThePhpGuild\QrCode\Matrix\Renderer\Painter;

use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Matrix\Renderer\Canvas\CanvasInterface;

class PdfDocumentPainter implements PainterInterface
{
    private CanvasInterface $canvas;

    private int $scale;

    public function setCanvas(CanvasInterface $canvas): self
    {
        $this->canvas = $canvas;

        return $this;
    }

    public function setScale(int $scale): self
    {
        $this->scale = $scale;

        return $this;
    }

    public function paint(Matrix $matrix): void
    {
        $startCol = 10;
        $startRow = 10;

        foreach ($matrix->getValuesFromTopLeft() as $rowColValue) {
            [$row, $col, $value] = $rowColValue;
            if ($value) {
                $this->canvas->paintRectangle(
                    'black',
                    $startCol + $col * $this->scale,
                    $startRow + $row * $this->scale,
                    $this->scale,
                    $this->scale
                );
            }
        }
    }
}
