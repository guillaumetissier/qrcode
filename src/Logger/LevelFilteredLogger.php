<?php

namespace ThePhpGuild\QrCode\Logger;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class LevelFilteredLogger implements LoggerInterface
{
    private ?LoggerInterface $logger = null;

    private ?string $logLevel = null;

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    public function setLogLevel(string $logLevel): self
    {
        $this->logLevel = $logLevel;

        return $this;
    }

    public function debug(string|\Stringable $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::DEBUG)) return;

        $this->logger->debug($message, $context);
    }

    public function info(string|\Stringable $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::INFO)) return;

        $this->logger->info($message, $context);
    }

    public function notice(\Stringable|string $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::NOTICE)) return;

        $this->logger->notice($message, $context);
    }

    public function warning(string|\Stringable $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::WARNING)) return;

        $this->logger->warning($message, $context);
    }

    public function error(string|\Stringable $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::ERROR)) return;

        $this->logger->error($message, $context);
    }

    public function critical(string|\Stringable $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::CRITICAL)) return;

        $this->logger->critical($message, $context);
    }

    public function alert(\Stringable|string $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::ALERT)) return;

        $this->logger->alert($message, $context);
    }

    public function emergency(\Stringable|string $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::EMERGENCY)) return;

        $this->logger->emergency($message, $context);
    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog($level)) return;

        $this->logger->log($level, $message, $context);
    }

    private function showLog(string $level): bool
    {
        $levels = [
            LogLevel::EMERGENCY => 1,
            LogLevel::ALERT     => 2,
            LogLevel::CRITICAL  => 3,
            LogLevel::ERROR     => 4,
            LogLevel::WARNING   => 5,
            LogLevel::NOTICE    => 6,
            LogLevel::INFO      => 7,
            LogLevel::DEBUG     => 8,
        ];

        if (!isset($levels[$level])) return false;

        return $levels[$level] >= $levels[$this->logLevel];
    }
}
