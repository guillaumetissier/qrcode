<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixPainter\Painter;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixPainter\Canvas\CanvasInterface;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class PdfDocumentPainter implements PainterInterface
{
    private const DEFAULT_SCALE = 10;

    private ?CanvasInterface $canvas = null;

    private int $scale = self::DEFAULT_SCALE;

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

    /**
     * @param BitMatrix $matrix
     * @return void
     *
     * @throws MissingInfoException
     */
    public function paint(BitMatrix $matrix): void
    {
        if ($this->canvas === null) {
            throw MissingInfoException::missingInfo('canvas', self::class);
        }

        $startCol = 10;
        $startRow = 10;

        foreach ($matrix->values(true) as $positionValue) {
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
