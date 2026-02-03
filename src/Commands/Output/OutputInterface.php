<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Commands\Output;

interface OutputInterface
{
    public function output(OutputOptionsInterface $options): bool;
}
