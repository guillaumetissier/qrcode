<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Version;

interface BitMatrixBuilderInterface
{
    public function withErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self;

    public function withVersion(Version $version): self;

    public function withData(BitStringInterface $data): self;

    public function build(): BitMatrix;
}
