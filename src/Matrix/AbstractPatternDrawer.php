<?php

namespace ThePhpGuild\QrCode\Matrix;

abstract class AbstractPatternDrawer
{
    protected ?QrMatrix $matrix = null;

    public function setMatrix(?QrMatrix $matrix): self
    {
        $this->matrix = $matrix;

        return $this;
    }

    abstract public function draw(): QrMatrix;
}
