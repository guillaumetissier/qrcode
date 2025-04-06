<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer;

interface PatternDrawerInterface
{
    public function draw(): QrMatrix;
}
