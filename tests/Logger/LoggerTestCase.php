<?php

namespace Guillaumetissier\QrCode\Tests\Logger;

use Guillaumetissier\QrCode\Logger\IOLoggerInterface;
use PHPUnit\Framework\TestCase;

class LoggerTestCase extends TestCase
{
    protected IOLoggerInterface $logger;

    protected function setUp(): void
    {
        $this->logger = $this->createMock(IOLoggerInterface::class);
    }
}
