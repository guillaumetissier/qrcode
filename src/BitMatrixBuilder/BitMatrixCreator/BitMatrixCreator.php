<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreatorInterface;
use Guillaumetissier\QrCode\Common\VersionDependentTrait;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class BitMatrixCreator implements BitMatrixCreatorInterface
{
    use VersionDependentTrait;

    public static function create(): self
    {
        return new self();
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @throws MissingInfoException
     */
    public function createEmptyMatrix(int $margin = 4): BitMatrix
    {
        return BitMatrix::empty($this->version()->size(), $margin);
    }
}
