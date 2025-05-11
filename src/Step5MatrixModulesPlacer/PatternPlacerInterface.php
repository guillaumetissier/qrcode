<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer;

use ThePhpGuild\QrCode\Matrix\Matrix;

interface PatternPlacerInterface
{
    public function place(): Matrix;
}
