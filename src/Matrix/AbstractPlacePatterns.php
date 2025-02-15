<?php

namespace ThePhpGuild\QrCode\Matrix;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;

abstract class AbstractPlacePatterns
{
    protected ?QrMatrix $matrix = null;

    public function setMatrix(?QrMatrix $matrix): self
    {
        $this->matrix = $matrix;

        return $this;
    }

    abstract public function execute(): QrMatrix;
}
