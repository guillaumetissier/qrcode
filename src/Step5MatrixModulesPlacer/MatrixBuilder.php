<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer;

use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Exception\NoDataException;
use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\AlignmentPatterns\Placer as AlignmentPatternsPlacer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\DataCodewords\Placer as DataCodewordsPlacer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FinderPatterns\Placer as FinderPatternsPlacer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\TimingPatterns\Placer as TimingPatternsPlacer;

class MatrixBuilder
{
    private ?Version $version = null;
    private ?string $data = null;

    public function __construct(
        private readonly MatrixSizeCalculator $sizeCalculator,
        private readonly TimingPatternsPlacer $timingPatternsPlacer,
        private readonly FinderPatternsPlacer $finderPatternsPlacer,
        private readonly AlignmentPatternsPlacer $alignmentPatternsPlacer,
        private readonly PatternPlacer $patternDrawer,
        private readonly DataCodewordsPlacer $dataCodewordsDrawer
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

    /**
     * @return Matrix
     * @throws NoDataException
     */
    public function build(): Matrix
    {
        $size = $this->sizeCalculator->setVersion($this->version)->calculate();
        $matrix = new Matrix($size);
        $matrix = $this->timingPatternsPlacer->setMatrix($matrix)->place();
        $matrix = $this->finderPatternsPlacer->setMatrix($matrix)->setVersion($this->version)->place();
        $matrix = $this->alignmentPatternsPlacer->setMatrix($matrix)->setVersion($this->version)->place();
        $matrix = $this->patternDrawer->setMatrix($matrix)->place();

        return $this->dataCodewordsDrawer->setMatrix($matrix)->setData($this->data)->place();
    }
}
