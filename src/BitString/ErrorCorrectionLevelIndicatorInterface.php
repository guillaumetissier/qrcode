<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\QrCode\Common\ErrorCorrectionLevelDependent;

interface ErrorCorrectionLevelIndicatorInterface extends BitStringAware, ErrorCorrectionLevelDependent
{
}
