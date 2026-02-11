<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixPainter\Painter;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Exception\NoDataException;
use Guillaumetissier\QrCode\BitMatrixPainter\Canvas\CanvasInterface;

final class ImagePainter implements PainterInterface
{
    private const DEFAULT_SCALE = 10;
    private const COLOR_BACKGROUND = 'white';
    private const COLOR_FOREGROUND = 'black';

    private ?CanvasInterface $canvas = null;

    private int $scale = self::DEFAULT_SCALE;

    public function withCanvas(CanvasInterface $canvas): self
    {
        $this->canvas = $canvas;

        return $this;
    }

    public function withScale(int $scale): self
    {
        if ($scale <= 0) {
            throw new \InvalidArgumentException('Scale must be a positive integer');
        }

        $this->scale = $scale;

        return $this;
    }

    /**
     * @throws NoDataException
     * @throws MissingInfoException
     */
    public function paint(BitMatrix $matrix): void
    {
        if ($this->canvas === null) {
            throw MissingInfoException::missingInfo('canvas', self::class);
        }

        if (0 === ($size = $matrix->size())) {
            throw new NoDataException();
        }

        $imageSize = $size * $this->scale;
        $this->canvas->paintRectangle(self::COLOR_BACKGROUND, 0, 0, $imageSize, $imageSize);

        // Paint foreground modules
        foreach ($matrix->values() as $positionValue) {
            [$position, $value] = $positionValue;
            $col = $position->col();
            $row = $position->row();

            if ($value) {
                $x1 = $col * $this->scale;
                $y1 = $row * $this->scale;
                $x2 = ($col + 1) * $this->scale;
                $y2 = ($row + 1) * $this->scale;

                $this->canvas->paintRectangle(self::COLOR_FOREGROUND, $x1, $y1, $x2, $y2);
            }
        }
    }
}
