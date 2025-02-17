<?php

namespace ThePhpGuild\QrCode\MatrixRenderer\Painter;

use ThePhpGuild\QrCode\MatrixRenderer\Canvas\CanvasInterface;

class PdfDocumentPainter implements PainterInterface
{
    public function paint(CanvasInterface $canvas, array $data, int $scale): void
    {
        $size = count($data);
        $startX = 10;
        $startY = 10;

        for ($y = 0; $y < $size; $y++) {
            for ($x = 0; $x < $size; $x++) {
                if ($data[$y][$x]) {
                    $canvas->paintRectangle('black', $startX + $x * $scale, $startY + $y * $scale, $scale, $scale);
                }
            }
        }
    }
}
