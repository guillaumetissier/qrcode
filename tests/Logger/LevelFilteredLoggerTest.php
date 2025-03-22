<?php

namespace Tests\Logger;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

class LevelFilteredLoggerTest extends TestCase
{
    private LevelFilteredLogger $logger;

    public function setUp(): void
    {
        $this->logger = new LevelFilteredLogger();
    }

    /**
     * @dataProvider provideDataToDebug
     */
    public function testDebug(string $level, bool $expectedMethodCalled): void
    {
        $this->logger->setLogger($this->getLogger('debug', $expectedMethodCalled));

        $this->logger->setLogLevel($level)->debug('Some message');
    }

    public static function provideDataToDebug(): array
    {
        return [
            [LogLevel::DEBUG, true],
            [LogLevel::INFO, false],
            [LogLevel::NOTICE, false],
            [LogLevel::WARNING, false],
            [LogLevel::ERROR, false],
            [LogLevel::CRITICAL, false],
            [LogLevel::ALERT, false],
            [LogLevel::EMERGENCY, false],
        ];
    }

    /**
     * @dataProvider provideDataToInfo
     */
    public function testInfo(string $level, bool $expectedMethodCalled): void
    {
        $this->logger->setLogger($this->getLogger('info', $expectedMethodCalled));

        $this->logger->setLogLevel($level)->info('Some message');
    }

    public static function provideDataToInfo(): array
    {
        return [
            [LogLevel::DEBUG, true],
            [LogLevel::INFO, true],
            [LogLevel::NOTICE, false],
            [LogLevel::WARNING, false],
            [LogLevel::ERROR, false],
            [LogLevel::CRITICAL, false],
            [LogLevel::ALERT, false],
            [LogLevel::EMERGENCY, false],
        ];
    }

    /**
     * @dataProvider provideDataToNotice
     */
    public function testNotice(string $level, bool $expectedMethodCalled): void
    {
        $this->logger->setLogger($this->getLogger('notice', $expectedMethodCalled));

        $this->logger->setLogLevel($level)->notice('Some message');
    }

    public static function provideDataToNotice(): array
    {
        return [
            [LogLevel::DEBUG, true],
            [LogLevel::INFO, true],
            [LogLevel::NOTICE, true],
            [LogLevel::WARNING, false],
            [LogLevel::ERROR, false],
            [LogLevel::CRITICAL, false],
            [LogLevel::ALERT, false],
            [LogLevel::EMERGENCY, false],
        ];
    }

    /**
     * @dataProvider provideDataToWarning
     */
    public function testWarning(string $level, bool $expectedMethodCalled): void
    {
        $this->logger->setLogger($this->getLogger('warning', $expectedMethodCalled));

        $this->logger->setLogLevel($level)->warning('Some message');
    }

    public static function provideDataToWarning(): array
    {
        return [
            [LogLevel::DEBUG, true],
            [LogLevel::INFO, true],
            [LogLevel::NOTICE, true],
            [LogLevel::WARNING, true],
            [LogLevel::ERROR, false],
            [LogLevel::CRITICAL, false],
            [LogLevel::ALERT, false],
            [LogLevel::EMERGENCY, false],
        ];
    }

    /**
     * @dataProvider provideDataToError
     */
    public function testError(string $level, bool $expectedMethodCalled): void
    {
        $this->logger->setLogger($this->getLogger('error', $expectedMethodCalled));

        $this->logger->setLogLevel($level)->error('Some message');
    }

    public static function provideDataToError(): array
    {
        return [
            [LogLevel::DEBUG, true],
            [LogLevel::INFO, true],
            [LogLevel::NOTICE, true],
            [LogLevel::WARNING, true],
            [LogLevel::ERROR, true],
            [LogLevel::CRITICAL, false],
            [LogLevel::ALERT, false],
            [LogLevel::EMERGENCY, false],
        ];
    }

    /**
     * @dataProvider provideDataToCritical
     */
    public function testCritical(string $level, bool $expectedMethodCalled): void
    {
        $this->logger->setLogger($this->getLogger('critical', $expectedMethodCalled));

        $this->logger->setLogLevel($level)->critical('Some message');
    }

    public static function provideDataToCritical(): array
    {
        return [
            [LogLevel::DEBUG, true],
            [LogLevel::INFO, true],
            [LogLevel::NOTICE, true],
            [LogLevel::WARNING, true],
            [LogLevel::ERROR, true],
            [LogLevel::CRITICAL, true],
            [LogLevel::ALERT, false],
            [LogLevel::EMERGENCY, false],
        ];
    }

    /**
     * @dataProvider provideDataToAlert
     */
    public function testAlert(string $level, bool $expectedMethodCalled): void
    {
        $this->logger->setLogger($this->getLogger('alert', $expectedMethodCalled));

        $this->logger->setLogLevel($level)->alert('Some message');
    }

    public static function provideDataToAlert(): array
    {
        return [
            [LogLevel::DEBUG, true],
            [LogLevel::INFO, true],
            [LogLevel::NOTICE, true],
            [LogLevel::WARNING, true],
            [LogLevel::ERROR, true],
            [LogLevel::CRITICAL, true],
            [LogLevel::ALERT, true],
            [LogLevel::EMERGENCY, false],
        ];
    }

    /**
     * @dataProvider provideDataToEmergency
     */
    public function testEmergency(string $level, bool $expectedMethodCalled): void
    {
        $this->logger->setLogger($this->getLogger('emergency', $expectedMethodCalled));

        $this->logger->setLogLevel($level)->emergency('Some message');
    }

    public static function provideDataToEmergency(): array
    {
        return [
            [LogLevel::DEBUG, true],
            [LogLevel::INFO, true],
            [LogLevel::NOTICE, true],
            [LogLevel::WARNING, true],
            [LogLevel::ERROR, true],
            [LogLevel::CRITICAL, true],
            [LogLevel::ALERT, true],
            [LogLevel::EMERGENCY, true],
        ];
    }

    /**
     * @throws Exception
     */
    private function getLogger(string $method, bool $isCalled): LoggerInterface
    {
        $calledMethods = [
            'debug' => false,
            'info' => false,
            'notice' => false,
            'warning' => false,
            'error' => false,
            'critical' => false,
            'alert' => false,
            'emergency' => false,
        ];
        $calledMethods[$method] = $isCalled;
        $logger = $this->createMock(LoggerInterface::class);
        foreach ($calledMethods as $calledMethod => $isCalled) {
            $logger->expects($isCalled ? $this->once() : $this->never())->method($calledMethod)->with('Some message');
        }

        return $logger;
    }
}
