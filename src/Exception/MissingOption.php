<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Exception;

final class MissingOption extends \Exception
{
    public function __construct(string $option)
    {
        parent::__construct("Missing option $option", ExceptionCode::MISSING_OPTION->value);
    }
}
