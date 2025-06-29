<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer;

use ThePhpGuild\QrCode\Matrix\Matrix;

interface FunctionPatternPlacerInterface
{
    public function place(Matrix $matrix): void;
}
