<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Exception;

final class NoDataException extends \Exception
{
    public function __construct()
    {
        parent::__construct('No data', ExceptionCode::NO_DATA->value);
    }
}
