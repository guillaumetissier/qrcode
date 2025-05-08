<?php

namespace ThePhpGuild\QrCode\Step2DataEncodation;

use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter\Factory as DataCodewordsCounterFactory;

// ISO/IEC 18004:2000(E)
// p. 28 table 7, 3rd Column
class DataCodewordsCounter
{
    private ?Version $version = null;

    private ?ErrorCorrectionLevel $errorCorrectionLevel = null;

    public function __construct(private readonly DataCodewordsCounterFactory $factory)
    {
    }

    public function setVersion(?Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function setErrorCorrectionLevel(?ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;

        return $this;
    }

    public function count(): int
    {
        return $this->factory->getDataCodewordsCounter($this->errorCorrectionLevel)
            ->setVersion($this->version)
            ->count();
    }
}
