<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreatorInterface;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

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
     * @throws MissingInfoException
     */
    public function createEmptyMatrix(): BitMatrix
    {
        if (!$this->version instanceof Version) {
            throw MissingInfoException::missingInfo('version', self::class);
        }

        return BitMatrix::empty($this->version->size());
    }
}
