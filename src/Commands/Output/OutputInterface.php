<?php

namespace Guillaumetissier\QrCode\Commands\Output;

interface OutputInterface
{
    public function output(OutputOptionsInterface $options): bool;
}
