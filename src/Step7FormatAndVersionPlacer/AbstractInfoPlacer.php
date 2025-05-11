<?php

namespace ThePhpGuild\QrCode\Step7FormatAndVersionPlacer;

use ThePhpGuild\QrCode\Matrix\Matrix;

abstract class AbstractInfoPlacer implements InfoPlacerInterface
{
    protected ?Matrix $matrix = null;

    public function setMatrix(?Matrix $matrix): self
    {
        $this->matrix = $matrix;

        return $this;
    }

    abstract public function placeInfo(string $info): Matrix;
}
