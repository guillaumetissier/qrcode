<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer;

use ThePhpGuild\QrCode\Enums\FunctionPatternType;
use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer\Factory as PatternsPlacerFactory;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer\PositionsDependent;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\Factory as PositionsFactory;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\SizeDependent;

class MatrixBuilder
{
    private ?Version $version = null;
    private ?string $data = null;

    public function __construct(
        private readonly PositionsFactory $positionsFactory,
        private readonly PatternsPlacerFactory $patternsPlacerFactory,
        private readonly MatrixSizeCalculator  $sizeCalculator
    )
    {
    }

    public function setVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function build(): Matrix
    {
        $size = $this->sizeCalculator->setVersion($this->version)->calculate();
        $matrix = new Matrix($size);

        foreach (FunctionPatternType::all() as $patternType) {
            $positions = $this->positionsFactory->create($patternType);
            $placer = $this->patternsPlacerFactory->create($patternType);

            if ($positions instanceof VersionDependent) {
                $positions->setVersion($this->version);
            } elseif ($positions instanceof SizeDependent) {
                $positions->setSize($size);
            }
            if ($placer instanceof DataDependent) {
                $placer->setData($this->data);
            }
            if ($placer instanceof PositionsDependent) {
                $placer->setPositions($positions);
            }
            $placer->place($matrix);
        }
        return $matrix;
    }
}
