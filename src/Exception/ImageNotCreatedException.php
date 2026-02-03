<?php

namespace Guillaumetissier\QrCode\Exception;

class ImageNotCreatedException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Image not created", ExceptionCode::IMAGE_NOT_CREATED->value);
    }
}
