<?php

namespace Tests\Fixture;

use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

trait IoLoggerTrait
{
    public function getIoLogger(): IOLoggerInterface
    {
        return new class implements IOLoggerInterface {

            public function input(\Stringable|string $input, array $context = []): void
            {}

            public function output(\Stringable|string $output, array $context = []): void
            {}

            public function emergency(\Stringable|string $message, array $context = []): void
            {}

            public function alert(\Stringable|string $message, array $context = []): void
            {}

            public function critical(\Stringable|string $message, array $context = []): void
            {}

            public function error(\Stringable|string $message, array $context = []): void
            {}

            public function warning(\Stringable|string $message, array $context = []): void
            {}

            public function notice(\Stringable|string $message, array $context = []): void
            {}

            public function info(\Stringable|string $message, array $context = []): void
            {}

            public function debug(\Stringable|string $message, array $context = []): void
            {}

            public function log($level, \Stringable|string $message, array $context = []): void
            {}
        };
    }
}