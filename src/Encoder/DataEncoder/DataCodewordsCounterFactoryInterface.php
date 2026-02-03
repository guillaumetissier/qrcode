<?php

namespace Guillaumetissier\QrCode\Encoder\DataEncoder;

use Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter\DataCodewordsCounterInterface;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

interface DataCodewordsCounterFactoryInterface
{
    public function getDataCodewordsCounter(ErrorCorrectionLevel $errorCorrectionLevel): DataCodewordsCounterInterface;
}
