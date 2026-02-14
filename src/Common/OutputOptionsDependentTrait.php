<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Common;

use Guillaumetissier\QrCode\Commands\Output\OutputOptionsInterface;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

trait OutputOptionsDependentTrait
{
    private ?OutputOptionsInterface $outputOptions = null;

    public function withOutputOptions(OutputOptionsInterface $outputOptions): self
    {
        $this->outputOptions = $outputOptions;

        return $this;
    }

    /**
     * @return OutputOptionsInterface
     * @throws MissingInfoException
     */
    protected function outputOptions(): OutputOptionsInterface
    {
        if ($this->outputOptions === null) {
            throw MissingInfoException::missingInfo('outputOptions', self::class);
        }

        return $this->outputOptions;
    }
}
