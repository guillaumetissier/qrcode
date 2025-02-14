<?php

namespace ThePhpGuild\Qrcode\MatrixRenderer;

use ThePhpGuild\Qrcode\Matrix\QrMatrix;

abstract class AbstractMatrixRenderer implements MatrixRendererInterface
{
    private ?string $filename = null;
    private ?QrMatrix $matrix = null;
    private int $scale = 10;

    public function setFilename(?string $filename): AbstractMatrixRenderer
    {
        $this->filename = $filename;

        return $this;
    }

    public function setMatrix(QrMatrix $matrix): self
    {
        $this->matrix = $matrix;

        return $this;
    }

    public function setScale(int $scale): self
    {
        $this->scale = $scale;

        return $this;
    }

    abstract public function render(): void;

    protected function getFilename(): ?string
    {
        return $this->filename;
    }

    protected function getMatrix(): array
    {
        return $this->matrix?->getMatrix() ?? [];
    }

    protected function getScale(): ?int
    {
        return $this->scale;
    }
}
