<?php

namespace ThePhpGuild\QrCode\Matrix\Renderer\Painter;

use ThePhpGuild\QrCode\Exception\NoDataException;
use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Matrix\Renderer\Canvas\CanvasInterface;
use ThePhpGuild\QrCode\Matrix\Renderer\Canvas\Image;

class ImagePainter implements PainterInterface
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

    /**
     * @throws NoDataException
     */
    public function paint(Matrix $matrix): void
    {
        if (0 === ($size = $matrix->getSize())) {
            throw new NoDataException();
        }

        $imageSize = $size * $this->scale;

        $this->canvas->paintRectangle(Image::WHITE, 0, 0, $imageSize, $imageSize);

        foreach ($matrix->getValuesFromTopLeft() as $rowColValue) {
            [$row, $col, $value] = $rowColValue;
            if ($value) {
                $this->canvas->paintRectangle(Image::BLACK,
                    $col * $this->scale,
                    $row * $this->scale,
                    ($col + 1) * $this->scale - 1,
                    ($row + 1) * $this->scale - 1
                );
            }
        }
    }
}
