<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer;

use ThePhpGuild\QrCode\Enums\Version;

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
