<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Logger;

use BackedEnum;
use Psr\Log\LoggerInterface;
use Stringable;

interface IOLoggerInterface extends LoggerInterface
{
    /**
     * @param string|Stringable|array<string, string|Stringable|BackedEnum> $input
     * @param array<string, string> $context
     * @return void
     */
    public function input(string|Stringable|array $input, array $context = []): void;

    /**
     * @param string|Stringable $output
     * @param array<string, string> $context
     * @return void
     */
    public function output(string|Stringable $output, array $context = []): void;
}
