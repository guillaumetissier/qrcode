<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Exception;

final class WrongValue extends \Exception
{
    public function __construct(string $variable, string $value)
    {
        parent::__construct("Wrong value ($value) for $variable", ExceptionCode::WRONG_VALUE->value);
    }
}
