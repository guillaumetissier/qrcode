<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions;

interface SizeDependent
{
    public function getSize(): ?int;

    public function setSize(int $size): self;
}
