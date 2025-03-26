<?php

namespace ThePhpGuild\QrCode\Logger;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class LevelFilteredLogger implements IOLoggerInterface
{
    private ?string $logLevel = null;

    public function __construct(private ?LoggerInterface $logger = null)
    {
    }

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    public function setLogLevel(string $logLevel): self
    {
        $this->logLevel = $logLevel;

        return $this;
    }

    public function input(string|\Stringable $input, array $context = []): void
    {
        $this->debug("I << $input", $context);
    }

    public function output(string|\Stringable $output, array $context = []): void
    {
        $this->debug("O >> $output", $context);
    }

    public function debug(string|\Stringable $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::DEBUG)) return;

        $this->logger->debug($this->addPrefix($message, $context), $context);
    }

    public function info(string|\Stringable $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::INFO)) return;

        $this->logger->info($this->addPrefix($message, $context), $context);
    }

    public function notice(\Stringable|string $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::NOTICE)) return;

        $this->logger->notice($this->addPrefix($message, $context), $context);
    }

    public function warning(string|\Stringable $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::WARNING)) return;

        $this->logger->warning($this->addPrefix($message, $context), $context);
    }

    public function error(string|\Stringable $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::ERROR)) return;

        $this->logger->error($this->addPrefix($message, $context), $context);
    }

    public function critical(string|\Stringable $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::CRITICAL)) return;

        $this->logger->critical($this->addPrefix($message, $context), $context);
    }

    public function alert(\Stringable|string $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::ALERT)) return;

        $this->logger->alert($this->addPrefix($message, $context), $context);
    }

    public function emergency(\Stringable|string $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::EMERGENCY)) return;

        $this->logger->emergency($this->addPrefix($message, $context), $context);
    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog($level)) return;

        $this->logger->log($level, $this->addPrefix($message, $context), $context);
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

        if (!$this->logLevel || !isset($levels[$this->logLevel]) || !isset($levels[$level])) return false;

        return $levels[$level] <= $levels[$this->logLevel];
    }

    private function addPrefix(string $message, array $context): string
    {
        return (null === ($prefix = $this->extractPrefix($context))) ? $message : $prefix . $message;
    }

    private function extractPrefix(array $context): ?string
    {
        if (null === ($class = $context['class'] ?? null)) {
            return null;
        }

        $classChunks = explode("\\", $class);

        return '[' . str_pad($classChunks[count($classChunks) - 1], 34, '.') .'] ';
    }
}
