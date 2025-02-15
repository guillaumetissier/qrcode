<?php

namespace ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;

abstract class AbstractCciBitsCounter implements CciBitsCounterInterface
{
    protected ?Version $version = null;

    public function getVersion(): ?Version
    {
        return $this->version;
    }

    public function setVersion(?Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    abstract public function count(): int;
}
