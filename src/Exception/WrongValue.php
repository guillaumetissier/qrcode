<?php

namespace Guillaumetissier\QrCode\Exception;

class WrongValue extends \Exception
{
    public function __construct(string $variable, string $value)
    {
        parent::__construct("Wrong value ($value) for $variable", ExceptionCode::WRONG_VALUE->value);
    }
}
