<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer;

interface DataDependent
{
    public function setData(string $data): self;
}
