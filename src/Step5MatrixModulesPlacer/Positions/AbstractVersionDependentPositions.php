<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions;

use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\VersionDependent;

abstract class AbstractVersionDependentPositions implements PositionsInterface, VersionDependent
{
    private ?Version $version = null;

    public function getVersion(): ?Version
    {
        return $this->version;
    }

    public function setVersion(?Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    abstract public function getPositions(): \Generator;
}
