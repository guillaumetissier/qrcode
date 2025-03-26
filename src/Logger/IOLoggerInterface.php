<?php

namespace ThePhpGuild\QrCode\Logger;

use Psr\Log\LoggerInterface;

interface IOLoggerInterface extends LoggerInterface
{
    public function input(string|\Stringable $input, array $context = []): void;

    public function output(string|\Stringable $output, array $context = []): void;
}
