<?php

namespace ThePhpGuild\QrCode\Matrix;

interface PatternDrawerInterface
{
    public function draw(): QrMatrix;
}
