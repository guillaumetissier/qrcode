<?php

namespace ThePhpGuild\QrCode\Matrix;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class MatrixSizeCalculator
{
    private ?Version $version = null;

    public function setVersion(?Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function calculate(): ?int
    {
        if ($this->version === null) {
            return null;
        }

        return 21 + 4 * ($this->version->value - 1);
    }
}
