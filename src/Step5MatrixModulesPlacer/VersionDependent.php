<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer;

use ThePhpGuild\QrCode\Enums\Version;

interface VersionDependent
{
    public function getVersion(): ?Version;

    public function setVersion(Version $version): self;
}
