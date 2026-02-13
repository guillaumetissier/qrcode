<?php

namespace Guillaumetissier\QrCode\Common;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

trait DataBitStringDependentTrait
{
    private ?BitStringInterface $data = null;

    public function withData(BitStringInterface $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return BitStringInterface
     * @throws MissingInfoException
     */
    protected function data(): BitStringInterface
    {
        if ($this->data === null) {
            throw MissingInfoException::missingInfo('data', self::class);
        }

        return $this->data;
    }
}
