<?php

namespace ThePhpGuild\QrCode\Matrix\FinderPatterns;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Matrix\MatrixSizeCalculator;
use ThePhpGuild\QrCode\Matrix\PositionsInterface;

class Positions implements PositionsInterface
{
    private ?Version $version = null;

    public function __construct(private readonly MatrixSizeCalculator $matrixSizeCalculator)
    {}

    public function setVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getPositions(): array
    {
        $size = $this->matrixSizeCalculator->setVersion($this->version)->calculate();
        return [
            [4, 4],
            [$size - 4, 4],
            [4, $size - 4],
        ];
    }
}
