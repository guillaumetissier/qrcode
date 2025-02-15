<?php

namespace ThePhpGuild\QrCode\Matrix;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Exception\NoDataException;

class MatrixBuilder
{
    private ?Version $version = null;
    private ?string $data = null;

    public function __construct(
        private readonly PlaceFinderPatterns $placeFinderPatterns,
        private readonly PlaceAlignmentPatterns $placeAlignmentPatterns,
        private readonly PlaceTimingPatterns $placeTimingPatterns,
        private readonly PlaceFormatAndVersionInfo $placeFormatAndVersionInfo,
        private readonly PlaceDataAndErrorCorrection $placeDataAndErrorCorrection
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
        $matrix = new QrMatrix($this->version);
        $matrix = $this->placeFinderPatterns->setMatrix($matrix)->execute();
        $matrix = $this->placeAlignmentPatterns->setMatrix($matrix)->setVersion($this->version)->execute();
        $matrix = $this->placeTimingPatterns->setMatrix($matrix)->execute();
        $matrix = $this->placeFormatAndVersionInfo->setMatrix($matrix)->execute();

        return $this->placeDataAndErrorCorrection->setMatrix($matrix)->setData($this->data)->execute();
    }
}
