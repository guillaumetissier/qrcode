<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Exception;

final class DataTooVoluminous extends \Exception
{
    public function __construct()
    {
        parent::__construct("Data too voluminous. It cannot be encoded.", ExceptionCode::DATA_TOO_VOLUMINOUS->value);
    }
}
