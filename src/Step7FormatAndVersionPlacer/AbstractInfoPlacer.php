<?php

namespace ThePhpGuild\QrCode\Step7FormatAndVersionPlacer;

use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\QrMatrix;

abstract class AbstractInfoPlacer implements InfoPlacerInterface
{
    protected ?QrMatrix $matrix = null;

    public function setMatrix(?QrMatrix $matrix): self
    {
        $this->matrix = $matrix;

        return $this;
    }

    abstract public function placeInfo(string $info): QrMatrix;
}
