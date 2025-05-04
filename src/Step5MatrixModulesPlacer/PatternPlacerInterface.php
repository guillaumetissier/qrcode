<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer;

interface PatternPlacerInterface
{
    public function place(): QrMatrix;
}
