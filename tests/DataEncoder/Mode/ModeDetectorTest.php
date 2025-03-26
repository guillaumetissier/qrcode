<?php

namespace Tests\DataEncoder\Mode;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Mode\Mode;
use ThePhpGuild\QrCode\DataEncoder\Mode\ModeDetector;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class ModeDetectorTest extends TestCase
{
    private ModeDetector $detector;

    public function setUp(): void
    {
        $this->detector = new ModeDetector($this->createMock(IOLoggerInterface::class));
    }

    /**
     * @dataProvider provideDataToDetect
     */
    public function testDetect(string $data, Mode $expectedMode): void
    {
        $this->assertEquals($expectedMode, $this->detector->setData($data)->detect());
    }

    public static function provideDataToDetect(): array
    {
        return [
            ['0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ $%*+-./:', Mode::ALPHANUMERIC],
            ['abcdefghijklmopqrtsuvwxyzéèà', Mode::BYTE],
            ['0123456789', Mode::NUMERIC],
        ];
    }
}
