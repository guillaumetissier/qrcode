<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\Common\DataBitStringDependent;

interface InfoModulePlacerInterface extends DataBitStringDependent
{
    public function place(BitMatrix $matrix): void;
}
