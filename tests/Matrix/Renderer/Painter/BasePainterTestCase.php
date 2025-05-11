<?php

namespace Tests\Matrix\Renderer\Painter;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Matrix\Renderer\Canvas\CanvasInterface;
use ThePhpGuild\QrCode\Matrix\Renderer\Painter\PainterInterface;

abstract class BasePainterTestCase extends TestCase
{
    private PainterInterface $painter;

    public function setUp(): void
    {
        $painterClass = $this->getPainterClass();
        $this->painter = new $painterClass();
    }

    /**
     * @dataProvider provideDataForPaint
     */
    public function testPaint(Matrix $matrix, int $expectedCallCounts): void
    {
        $canvas = $this->getCanvasMock($expectedCallCounts);
        $this->painter->setCanvas($canvas)->setScale(1)->paint($matrix);
    }

    public static function provideDataForPaint(): \Generator
    {
        throw new \Exception('Not implemented');
    }

    abstract protected function getPainterClass(): string;

    protected function getCanvasMock(int $expectedCallCounts): CanvasInterface
    {
        /** @var CanvasInterface $canvas */
        $canvas = $this->createMock(CanvasInterface::class);
        $canvas->expects($this->exactly($expectedCallCounts))->method('paintRectangle');

        return $canvas;
    }
}
