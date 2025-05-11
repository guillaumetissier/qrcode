<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer;

use ThePhpGuild\QrCode\Matrix\Matrix;

abstract class AbstractPatternPlacer implements PatternPlacerInterface
{
    protected ?Matrix $matrix = null;

    public function setMatrix(?Matrix $matrix): self
    {
        $this->matrix = $matrix;

        return $this;
    }

    abstract public function place(): Matrix;
}
