<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Encoder\DataSplitter\DataBlockInterface;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Version;

interface DataSplitterInterface
{
    public function withVersion(Version $version): self;

    public function withErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self;

    /**
     * @param BitStringInterface $dataCodewords
     * @return array<DataBlockInterface>
     */
    public function split(BitStringInterface $dataCodewords): array;
}
