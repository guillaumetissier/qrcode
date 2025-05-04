<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer;

abstract class AbstractPatternPlacer implements PatternPlacerInterface
{
    protected ?QrMatrix $matrix = null;

    public function setMatrix(?QrMatrix $matrix): self
    {
        $this->matrix = $matrix;

        return $this;
    }

    abstract public function place(): QrMatrix;
}
