<?php

namespace Guillaumetissier\QrCode\Exception;

class DataTooVoluminous extends \Exception
{
    public function __construct()
    {
        parent::__construct("Data too voluminous. It cannot be encoded.", ExceptionCode::DATA_TOO_VOLUMINOUS->value);
    }
}
