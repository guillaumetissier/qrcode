<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FinderPatterns;

use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\MatrixSizeCalculator;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\PositionsInterface;

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
