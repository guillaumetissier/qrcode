<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataAnalyser\Mode;

use Guillaumetissier\QrCode\Encoder\DataAnalyser\Mode\ModeDetector;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;
use PHPUnit\Framework\TestCase;

class ModeDetectorTest extends TestCase
{
    private ModeDetector $detector;

    public function setUp(): void
    {
        $this->detector = ModeDetector::create($this->createMock(IOLoggerInterface::class));
    }

    /**
     * @dataProvider provideDataToDetect
     */
    public function testDetect(string $data, Mode $expectedMode): void
    {
        $this->assertEquals($expectedMode, $this->detector->withData($data)->detect());
    }

    /**
     * @return array<array{string, Mode}>
     */
    public static function provideDataToDetect(): array
    {
        return [
            ['0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ $%*+-./:', Mode::ALPHANUMERIC],
            ['abcdefghijklmopqrtsuvwxyzéèà', Mode::BYTE],
            ['0123456789', Mode::NUMERIC],
        ];
    }
}
