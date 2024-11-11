<?php

namespace ThePhpGuild\Qrcode\Matrix;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class MatrixBuilder
{
    private ?Version $version = null;
    private $data = null;

    public function __construct(
        private readonly PlaceFinderPatterns $placeFinderPatterns,
        private readonly PlaceAlignmentPatterns $placeAlignmentPatterns,
        private readonly PlaceTimingPatterns $placeTimingPatterns,
        private readonly PlaceFormatAndVersionInfo $placeFormatAndVersionInfo
    )
    {
    }

    public function setVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }

    public function build(): QrMatrix
    {
        $matrix = new QrMatrix($this->version);
        $matrix = $this->placeFinderPatterns->setMatrix($matrix)->execute();
        $matrix = $this->placeAlignmentPatterns->setMatrix($matrix)->setVersion($this->version)->execute();
        $matrix = $this->placeTimingPatterns->setMatrix($matrix)->execute();
        $matrix = $this->placeFormatAndVersionInfo->setMatrix($matrix)->execute();

        return $matrix;
    }
}
