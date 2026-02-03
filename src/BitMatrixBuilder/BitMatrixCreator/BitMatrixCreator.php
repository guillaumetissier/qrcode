<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreatorInterface;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingParameter;

final class BitMatrixCreator implements BitMatrixCreatorInterface
{
    private ?Version $version = null;

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

    public function withVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @throws MissingParameter
     */
    public function createEmptyMatrix(): BitMatrix
    {
        if (!$this->version instanceof Version) {
            throw MissingParameter::missingParameter('version', self::class);
        }

        return BitMatrix::empty($this->version->size());
    }
}
