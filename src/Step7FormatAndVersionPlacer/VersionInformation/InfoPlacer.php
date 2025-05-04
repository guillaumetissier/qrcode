<?php

namespace ThePhpGuild\QrCode\Step7FormatAndVersionPlacer\VersionInformation;

use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\QrMatrix;
use ThePhpGuild\QrCode\Step7FormatAndVersionPlacer\AbstractInfoPlacer;

class InfoPlacer extends AbstractInfoPlacer
{
    public function placeInfo(string $info): QrMatrix
    {
        return $this->matrix;
    }
}
