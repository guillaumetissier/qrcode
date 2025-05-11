<?php

namespace ThePhpGuild\QrCode\Step7FormatAndVersionPlacer\VersionInformation;

use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Step7FormatAndVersionPlacer\AbstractInfoPlacer;

class InfoPlacer extends AbstractInfoPlacer
{
    public function placeInfo(string $info): Matrix
    {
        return $this->matrix;
    }
}
