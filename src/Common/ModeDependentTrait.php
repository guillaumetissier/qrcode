<?php

namespace Guillaumetissier\QrCode\Common;

use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

trait ModeDependentTrait
{
    private ?Mode $mode = null;

    public function withMode(Mode $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * @return Mode
     * @throws MissingInfoException
     */
    protected function mode(): Mode
    {
        if ($this->mode === null) {
            throw MissingInfoException::missingInfo('mode', self::class);
        }

        return $this->mode;
    }
}
