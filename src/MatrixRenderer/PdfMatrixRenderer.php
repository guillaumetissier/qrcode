<?php

namespace ThePhpGuild\QrCode\MatrixRenderer;

use TCPDF;

class PdfMatrixRenderer extends AbstractMatrixRenderer
{
    public function render(): void
    {
        $data = $this->getMatrix();
        $size = count($data);
        $cellSize = $this->getScale();

        $pdf = new TCPDF();
        $pdf->AddPage();

        $startX = 10;
        $startY = 10;

        for ($y = 0; $y < $size; $y++) {
            for ($x = 0; $x < $size; $x++) {
                if ($data[$y][$x]) {
                    $pdf->Rect(
                        $startX + $x * $cellSize,
                        $startY + $y * $cellSize,
                        $cellSize,
                        $cellSize,
                        'F'
                    );
                }
            }
        }

        $pdf->Output('qrcode.pdf', 'I');
    }
}
