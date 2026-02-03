<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Exception;

final class UnhandledFileTypeException extends \Exception
{
    public function __construct(string $extension = '')
    {
        parent::__construct("Unhandled file type $extension", ExceptionCode::UNHANDLED_FILE_TYPE->value);
    }
}
