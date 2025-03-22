<?php

namespace Tests\Logger;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

class LoggerTestCase extends TestCase
{
    protected LevelFilteredLogger $logger;

    protected function setUp(): void
    {
        $this->logger = $this->createMock(LevelFilteredLogger::class);
    }
}
