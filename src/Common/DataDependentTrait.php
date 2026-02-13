<?php

namespace Guillaumetissier\QrCode\Common;

use Guillaumetissier\QrCode\Exception\MissingInfoException;

trait DataDependentTrait
{
    private ?string $data = null;

    public function withData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return string
     * @throws MissingInfoException
     */
    protected function data(): string
    {
        if ($this->data === null) {
            throw MissingInfoException::missingInfo('data', self::class);
        }

        return $this->data;
    }
}
