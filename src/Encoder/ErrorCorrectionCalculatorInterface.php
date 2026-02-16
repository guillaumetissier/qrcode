<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Encoder\DataSplitter\DataBlockInterface;

interface ErrorCorrectionCalculatorInterface
{
    public function calculateErrorCorrection(DataBlockInterface $dataBlock): BitStringInterface;
}
