<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Enums\Version;

interface DataEncoderInterface
{
    public function withData(string $data): self;

    public function withMode(Mode $mode): self;

    public function withVersion(Version $version): self;

    public function withErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self;

    public function encode(): BitString;
}
