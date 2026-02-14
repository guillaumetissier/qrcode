<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Common;

use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

trait VersionDependentTrait
{
    private ?Version $version = null;

    public function withVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return Version
     * @throws MissingInfoException
     */
    protected function version(): Version
    {
        if ($this->version === null) {
            throw MissingInfoException::missingInfo('version', self::class);
        }

        return $this->version;
    }
}
