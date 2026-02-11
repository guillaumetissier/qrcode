<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Logger;

use BackedEnum;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Stringable;

final class LevelFilteredLogger implements IOLoggerInterface
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

    /**
     * @param Stringable|string|array<string, string|Stringable|BackedEnum> $input
     * @param array<string, string> $context
     * @return void
     */
    public function input(string|Stringable|array $input, array $context = []): void
    {
        if (is_array($input)) {
            $inputs = [];
            foreach ($input as $key => $value) {
                if ($value instanceof BackedEnum) {
                    $inputs[] = "$key: {$value->value}";
                } else {
                    $inputs[] = "$key: $value";
                }
            }
            $this->debug("IN  << " . implode(', ', $inputs), $context);
        } else {
            $this->debug("IN  << $input", $context);
        }
    }

    /**
     * @param Stringable|string $output
     * @param array<string, string> $context
     * @return void
     */
    public function output(string|Stringable $output, array $context = []): void
    {
        $this->debug("OUT >> $output", $context);
    }

    /**
     * @param Stringable|string $message
     * @param array<string, string> $context
     * @return void
     */
    public function debug(string|Stringable $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::DEBUG)) {
            return;
        }

        $this->logger->debug($this->addPrefix($message, $context), $context);
    }

    /**
     * @param Stringable|string $message
     * @param array<string, string> $context
     * @return void
     */
    public function info(string|Stringable $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::INFO)) {
            return;
        }

        $this->logger->info($this->addPrefix($message, $context), $context);
    }

    /**
     * @param Stringable|string $message
     * @param array<string, string> $context
     * @return void
     */
    public function notice(Stringable|string $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::NOTICE)) {
            return;
        }

        $this->logger->notice($this->addPrefix($message, $context), $context);
    }

    /**
     * @param Stringable|string $message
     * @param array<string, string> $context
     * @return void
     */
    public function warning(string|Stringable $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::WARNING)) {
            return;
        }

        $this->logger->warning($this->addPrefix($message, $context), $context);
    }

    /**
     * @param Stringable|string $message
     * @param array<string, string> $context
     * @return void
     */
    public function error(string|Stringable $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::ERROR)) {
            return;
        }

        $this->logger->error($this->addPrefix($message, $context), $context);
    }

    /**
     * @param Stringable|string $message
     * @param array<string, string> $context
     * @return void
     */
    public function critical(string|Stringable $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::CRITICAL)) {
            return;
        }

        $this->logger->critical($this->addPrefix($message, $context), $context);
    }

    /**
     * @param Stringable|string $message
     * @param array<string, string> $context
     * @return void
     */
    public function alert(Stringable|string $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::ALERT)) {
            return;
        }

        $this->logger->alert($this->addPrefix($message, $context), $context);
    }

    /**
     * @param Stringable|string $message
     * @param array<string, string> $context
     * @return void
     */
    public function emergency(Stringable|string $message, array $context = []): void
    {
        if (!$this->logger || !$this->showLog(LogLevel::EMERGENCY)) {
            return;
        }

        $this->logger->emergency($this->addPrefix($message, $context), $context);
    }

    /**
     * @param mixed $level
     * @param Stringable|string $message
     * @param array<string, string> $context
     * @return void
     */
    public function log($level, Stringable|string $message, array $context = []): void
    {
        if (!$this->logger || !is_string($level) || !$this->showLog($level)) {
            return;
        }

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

        if (!$this->logLevel || !isset($levels[$this->logLevel]) || !isset($levels[$level])) {
            return false;
        }

        return $levels[$level] <= $levels[$this->logLevel];
    }

    /**
     * @param string|Stringable $message
     * @param array<string, string> $context
     * @return string
     */
    private function addPrefix(string|Stringable $message, array $context): string
    {
        return (null === ($prefix = $this->extractPrefix($context))) ? "$message" : "$prefix$message";
    }

    /**
     * @param array<string, string> $context
     * @return ?string
     */
    private function extractPrefix(array $context): ?string
    {
        if (null === ($class = $context['class'] ?? null)) {
            return null;
        }

        $classChunks = explode("\\", $class);

        return '[' . str_pad($classChunks[count($classChunks) - 1], 34, '.') . '] ';
    }
}
