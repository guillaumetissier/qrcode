<?php

namespace ThePhpGuild\QrCode\Logger;

use Psr\Log\LoggerInterface;

class ConsoleLogger implements LoggerInterface
{
    public function emergency(\Stringable|string $message, array $context = []): void
    {
        echo "[EME] $message" . PHP_EOL;
    }

    public function alert(\Stringable|string $message, array $context = []): void
    {
        echo "[ALE] $message" . PHP_EOL;
    }

    public function critical(\Stringable|string $message, array $context = []): void
    {
        echo "[CRI] $message" . PHP_EOL;
    }

    public function error(\Stringable|string $message, array $context = []): void
    {
        echo "[ERR] $message" . PHP_EOL;
    }

    public function warning(\Stringable|string $message, array $context = []): void
    {
        echo "[WAR] $message" . PHP_EOL;
    }

    public function notice(\Stringable|string $message, array $context = []): void
    {
        echo "[NOT] $message" . PHP_EOL;
    }

    public function info(\Stringable|string $message, array $context = []): void
    {
        echo "[INF] $message" . PHP_EOL;
    }

    public function debug(\Stringable|string $message, array $context = []): void
    {
        echo "[DEB] $message" . PHP_EOL;
    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        // TODO: Implement log() method.
    }
}