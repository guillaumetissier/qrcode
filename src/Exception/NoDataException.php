<?php

namespace Guillaumetissier\QrCode\Exception;

class NoDataException extends \Exception
{
    public function __construct()
    {
        parent::__construct('No data', ExceptionCode::NO_DATA->value);
    }
}
