<?php

namespace ThePhpGuild\QrCode\MatrixRenderer\Output;

interface OutputInterface
{
    public function output(OutputOptions $options): bool;
}
