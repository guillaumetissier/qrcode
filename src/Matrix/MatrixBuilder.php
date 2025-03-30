<?php

namespace ThePhpGuild\QrCode\Matrix;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Exception\NoDataException;
use ThePhpGuild\QrCode\Matrix\AlignmentPatterns\Drawer as AlignmentPatternsDrawer;
use ThePhpGuild\QrCode\Matrix\FinderPatterns\Drawer as FinderPatternsDrawer;

class MatrixBuilder
{
    private ?Version $version = null;
    private ?string $data = null;

    public function __construct(
        private readonly MatrixSizeCalculator $sizeCalculator,
        private readonly TimingPatternsDrawer $timingPatternsDrawer,
        private readonly FinderPatternsDrawer $finderPatternsDrawer,
        private readonly AlignmentPatternsDrawer $alignmentPatternsDrawer,
        private readonly PatternDrawer $patternDrawer,
        private readonly FormatAndVersionInfoDrawer $formatAndVersionInfoDrawer,
        private readonly DataAndErrorCorrectionDrawer $dataAndErrorCorrectionDrawer
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
     * @return QrMatrix
     * @throws NoDataException
     */
    public function build(): QrMatrix
    {
        $size = $this->sizeCalculator->setVersion($this->version)->calculate();
        $matrix = new QrMatrix($size);
        $matrix = $this->timingPatternsDrawer->setMatrix($matrix)->draw();
        $matrix = $this->finderPatternsDrawer->setMatrix($matrix)->draw();
        $matrix = $this->alignmentPatternsDrawer->setMatrix($matrix)->setVersion($this->version)->draw();
        $matrix = $this->patternDrawer->setMatrix($matrix)->draw();
        $matrix = $this->formatAndVersionInfoDrawer->setMatrix($matrix)->draw();

        return $this->dataAndErrorCorrectionDrawer->setMatrix($matrix)->setData($this->data)->draw();
    }
}
