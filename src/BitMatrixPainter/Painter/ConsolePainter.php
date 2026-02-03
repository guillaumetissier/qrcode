<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixPainter\Painter;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixPainter\Canvas\CanvasInterface;

final class ConsolePainter implements PainterInterface
{
    public function paint(BitMatrix $matrix): void
    {
        echo "$matrix";
    }

    public function withCanvas(CanvasInterface $canvas): PainterInterface
    {
        return $this;
    }

    public function withScale(int $scale): PainterInterface
    {
        return $this;
    }
}
