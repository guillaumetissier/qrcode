<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixPainter\Painter;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixPainter\Canvas\CanvasInterface;
use Guillaumetissier\QrCode\BitMatrixPainter\Painter\ImagePainter;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Exception\NoDataException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ImagePainterTest extends TestCase
{
    private CanvasInterface $canvas;
    private ImagePainter $painter;

    protected function setUp(): void
    {
        $this->canvas = $this->createMock(CanvasInterface::class);
        $this->painter = new ImagePainter();
    }

    public function testWithCanvasReturnsFluentInterface(): void
    {
        $this->assertSame($this->painter, $this->painter->withCanvas($this->canvas));
    }

    public function testWithScaleReturnsFluentInterface(): void
    {
        $this->assertSame($this->painter, $this->painter->withScale(5));
    }

    public function testWithScaleThrowsExceptionForZero(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Scale must be a positive integer');

        $this->painter->withScale(0);
    }

    public function testWithScaleThrowsExceptionForNegative(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Scale must be a positive integer');

        $this->painter->withScale(-5);
    }

    public function testPaintThrowsExceptionWhenCanvasNotSet(): void
    {
        $matrix = $this->createMock(BitMatrix::class);
        $matrix->method('size')->willReturn(10);

        $this->expectException(MissingInfoException::class);

        $this->painter->paint($matrix);
    }

    public function testPaintThrowsExceptionForEmptyMatrix(): void
    {
        $matrix = $this->createMock(BitMatrix::class);
        $matrix->method('size')->willReturn(0);

        $this->painter->withCanvas($this->canvas);

        $this->expectException(NoDataException::class);

        $this->painter->paint($matrix);
    }

    public function testPaintDrawsBackgroundRectangle(): void
    {
        $matrix = $this->createMock(BitMatrix::class);
        $matrix->method('size')->willReturn(5);
        $matrix->method('getValuesFromTopLeft')->willReturn((function () {
            return;
            yield;
        })());

        $this->canvas
            ->expects($this->once())
            ->method('paintRectangle')
            ->with('white', 0, 0, 50, 50); // 5 * 10 (default scale)

        $this->painter
            ->withCanvas($this->canvas)
            ->paint($matrix);
    }

    public function testPaintDrawsBackgroundWithCustomScale(): void
    {
        $matrix = $this->createMock(BitMatrix::class);
        $matrix->method('size')->willReturn(5);
        $matrix->method('getValuesFromTopLeft')->willReturn((function () {
            return;
            yield;
        })());

        $this->canvas
            ->expects($this->once())
            ->method('paintRectangle')
            ->with('white', 0, 0, 100, 100); // 5 * 20 (custom scale)

        $this->painter
            ->withCanvas($this->canvas)
            ->withScale(20)
            ->paint($matrix);
    }

    public function testPaintDrawsSingleBlackModule(): void
    {
        $matrix = $this->createMock(BitMatrix::class);
        $matrix->method('size')->willReturn(3);
        $matrix->method('getValuesFromTopLeft')->willReturn((function () {
            yield [Position::fromTopLeft(0, 0), true];
        })());

        $this->canvas
            ->expects($this->exactly(2))
            ->method('paintRectangle')
            ->willReturnCallback(function ($color, $x1, $y1, $x2, $y2) {
                static $callCount = 0;
                $callCount++;

                if ($callCount === 1) {
                    // Background
                    $this->assertEquals('white', $color);
                    $this->assertEquals(0, $x1);
                    $this->assertEquals(0, $y1);
                    $this->assertEquals(30, $x2);
                    $this->assertEquals(30, $y2);
                } elseif ($callCount === 2) {
                    // Black module
                    $this->assertEquals('black', $color);
                    $this->assertEquals(0, $x1);
                    $this->assertEquals(0, $y1);
                    $this->assertEquals(10, $x2);
                    $this->assertEquals(10, $y2);
                }

                return true;
            });

        $this->painter
            ->withCanvas($this->canvas)
            ->paint($matrix);
    }

    public function testPaintIgnoresWhiteModules(): void
    {
        $matrix = $this->createMock(BitMatrix::class);
        $matrix->method('size')->willReturn(2);
        $matrix->method('getValuesFromTopLeft')->willReturn((function () {
            yield [Position::fromTopLeft(0, 0), false]; // White module - should not paint
            yield [Position::fromTopLeft(0, 1), false]; // White module - should not paint
        })());

        $this->canvas
            ->expects($this->once()) // Only background
            ->method('paintRectangle')
            ->with('white', 0, 0, 20, 20);

        $this->painter
            ->withCanvas($this->canvas)
            ->paint($matrix);
    }

    public function testPaintDrawsMultipleBlackModules(): void
    {
        $matrix = $this->createMock(BitMatrix::class);
        $matrix->method('size')->willReturn(3);
        $matrix->method('getValuesFromTopLeft')->willReturn((function () {
            yield [Position::fromTopLeft(0, 0), true];  // Black at (0,0)
            yield [Position::fromTopLeft(0, 1), false]; // White at (0,1)
            yield [Position::fromTopLeft(1, 0), false]; // White at (1,0)
            yield [Position::fromTopLeft(1, 1), true];  // Black at (1,1)
            yield [Position::fromTopLeft(2, 2), true];  // Black at (2,2)
        })());

        $expectedCalls = [
            ['white', 0, 0, 30, 30],    // Background
            ['black', 0, 0, 10, 10],    // Module (0,0)
            ['black', 10, 10, 20, 20],  // Module (1,1)
            ['black', 20, 20, 30, 30],  // Module (2,2)
        ];

        $this->canvas
            ->expects($this->exactly(4))
            ->method('paintRectangle')
            ->willReturnCallback(function ($color, $x1, $y1, $x2, $y2) use (&$expectedCalls) {
                static $callIndex = 0;
                $expected = $expectedCalls[$callIndex++];

                $this->assertEquals($expected[0], $color);
                $this->assertEquals($expected[1], $x1);
                $this->assertEquals($expected[2], $y1);
                $this->assertEquals($expected[3], $x2);
                $this->assertEquals($expected[4], $y2);

                return true;
            });

        $this->painter
            ->withCanvas($this->canvas)
            ->paint($matrix);
    }

    public function testPaintWithCustomScaleCalculatesCorrectCoordinates(): void
    {
        $matrix = $this->createMock(BitMatrix::class);
        $matrix->method('size')->willReturn(2);
        $matrix->method('getValuesFromTopLeft')->willReturn((function () {
            yield [Position::fromTopLeft(0, 0), true]; // White module - should not paint
            yield [Position::fromTopLeft(0, 1), true]; // White module - should not paint
        })());

        $scale = 5;
        $expectedCalls = [
            ['white', 0, 0, 10, 10],   // Background (2*5)
            ['black', 0, 0, 5, 5],     // Module (0,0) with scale 5
            ['black', 0, 5, 5, 10],   // Module (0,1) with scale 5
        ];

        $this->canvas
            ->expects($this->exactly(3))
            ->method('paintRectangle')
            ->willReturnCallback(function ($color, $x1, $y1, $x2, $y2) use (&$expectedCalls) {
                static $callIndex = 0;
                $expected = $expectedCalls[$callIndex++];
                $this->assertEquals($expected[0], $color);
                $this->assertEquals($expected[1], $x1);
                $this->assertEquals($expected[2], $y1);
                $this->assertEquals($expected[3], $x2);
                $this->assertEquals($expected[4], $y2);

                return true;
            });

        $this->painter
            ->withCanvas($this->canvas)
            ->withScale($scale)
            ->paint($matrix);
    }

    public function testPaintHandlesLargeMatrix(): void
    {
        $size = 100;
        $matrix = $this->createMock(BitMatrix::class);
        $matrix->method('size')->willReturn($size);
        $matrix->method('getValuesFromTopLeft')->willReturn((function () use ($size) {
            for ($row = 0; $row < $size; $row++) {
                for ($col = 0; $col < $size; $col++) {
                    yield [Position::fromTopLeft($row, $col), ($row + $col) % 2 === 0];
                }
            }
        })());

        $this->canvas->method('paintRectangle')->willReturn(true);

        // Should not throw any exceptions
        $this->painter
            ->withCanvas($this->canvas)
            ->withScale(1)
            ->paint($matrix);

        $this->assertTrue(true);
    }

    public function testFluentInterfaceChaining(): void
    {
        $this->assertSame(
            $this->painter,
            $this->painter->withCanvas($this->canvas)->withScale(7)
        );
    }
}
