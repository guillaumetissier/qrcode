<?php

namespace ThePhpGuild\QrCode\Matrix\Renderer\Output;

interface OutputInterface
{
    public function output(OutputOptions $options): bool;
}
