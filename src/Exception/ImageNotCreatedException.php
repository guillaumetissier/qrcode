<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Exception;

final class ImageNotCreatedException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Image not created", ExceptionCode::IMAGE_NOT_CREATED->value);
    }
}
