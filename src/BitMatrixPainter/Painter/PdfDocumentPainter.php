<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixPainter\Painter;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixPainter\Canvas\CanvasInterface;

final class PdfDocumentPainter implements PainterInterface
{
    private CanvasInterface $canvas;

    private int $scale;

    public function withCanvas(CanvasInterface $canvas): self
    {
        $this->canvas = $canvas;

        return $this;
    }

    public function withScale(int $scale): self
    {
        $this->scale = $scale;

        return $this;
    }

    public function paint(BitMatrix $matrix): void
    {
        $startCol = 10;
        $startRow = 10;

        foreach ($matrix->getValuesFromTopLeft() as $positionValue) {
            [$position, $value] = $positionValue;
            $col = $position->col();
            $row = $position->row();

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
