<?php

namespace ThePhpGuild\Qrcode\MatrixRenderer;

use ThePhpGuild\Qrcode\Matrix\QrMatrix;

abstract class AbstractMatrixRenderer implements MatrixRendererInterface
{
    protected ?QrMatrix $qrMatrix = null;

    public function setMatrix(QrMatrix $matrix): self
    {
        $this->qrMatrix = $matrix;

        return $this;
    }

    abstract public function render();
}
