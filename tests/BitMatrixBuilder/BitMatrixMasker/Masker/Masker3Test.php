<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\BitMatrixMasker\Masker;

use Generator;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\Masker3;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\MaskerInterface;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;

class Masker3Test extends MaskerTestCase
{
    protected function createMasker(): MaskerInterface
    {
        return new Masker3();
    }

    public static function dataMask(): Generator
    {
        yield [
            BitMatrix::zeros(Version::V01->size()),
            '█  █  █  █  █  █  █  ' . PHP_EOL .
            '  █  █  █  █  █  █  █' . PHP_EOL .
            ' █  █  █  █  █  █  █ ' . PHP_EOL .
            '█  █  █  █  █  █  █  ' . PHP_EOL .
            '  █  █  █  █  █  █  █' . PHP_EOL .
            ' █  █  █  █  █  █  █ ' . PHP_EOL .
            '█  █  █  █  █  █  █  ' . PHP_EOL .
            '  █  █  █  █  █  █  █' . PHP_EOL .
            ' █  █  █  █  █  █  █ ' . PHP_EOL .
            '█  █  █  █  █  █  █  ' . PHP_EOL .
            '  █  █  █  █  █  █  █' . PHP_EOL .
            ' █  █  █  █  █  █  █ ' . PHP_EOL .
            '█  █  █  █  █  █  █  ' . PHP_EOL .
            '  █  █  █  █  █  █  █' . PHP_EOL .
            ' █  █  █  █  █  █  █ ' . PHP_EOL .
            '█  █  █  █  █  █  █  ' . PHP_EOL .
            '  █  █  █  █  █  █  █' . PHP_EOL .
            ' █  █  █  █  █  █  █ ' . PHP_EOL .
            '█  █  █  █  █  █  █  ' . PHP_EOL .
            '  █  █  █  █  █  █  █' . PHP_EOL .
            ' █  █  █  █  █  █  █ ' . PHP_EOL,
        ];

        yield [
            BitMatrix::ones(Version::V01->size()),
            ' ██ ██ ██ ██ ██ ██ ██' . PHP_EOL .
            '██ ██ ██ ██ ██ ██ ██ ' . PHP_EOL .
            '█ ██ ██ ██ ██ ██ ██ █' . PHP_EOL .
            ' ██ ██ ██ ██ ██ ██ ██' . PHP_EOL .
            '██ ██ ██ ██ ██ ██ ██ ' . PHP_EOL .
            '█ ██ ██ ██ ██ ██ ██ █' . PHP_EOL .
            ' ██ ██ ██ ██ ██ ██ ██' . PHP_EOL .
            '██ ██ ██ ██ ██ ██ ██ ' . PHP_EOL .
            '█ ██ ██ ██ ██ ██ ██ █' . PHP_EOL .
            ' ██ ██ ██ ██ ██ ██ ██' . PHP_EOL .
            '██ ██ ██ ██ ██ ██ ██ ' . PHP_EOL .
            '█ ██ ██ ██ ██ ██ ██ █' . PHP_EOL .
            ' ██ ██ ██ ██ ██ ██ ██' . PHP_EOL .
            '██ ██ ██ ██ ██ ██ ██ ' . PHP_EOL .
            '█ ██ ██ ██ ██ ██ ██ █' . PHP_EOL .
            ' ██ ██ ██ ██ ██ ██ ██' . PHP_EOL .
            '██ ██ ██ ██ ██ ██ ██ ' . PHP_EOL .
            '█ ██ ██ ██ ██ ██ ██ █' . PHP_EOL .
            ' ██ ██ ██ ██ ██ ██ ██' . PHP_EOL .
            '██ ██ ██ ██ ██ ██ ██ ' . PHP_EOL .
            '█ ██ ██ ██ ██ ██ ██ █' . PHP_EOL,
        ];
    }

    public static function dataMaskWithFunctionPatternPositions(): Generator
    {
        $positions = [];
        for ($col = 0; $col < 10; $col++) {
            for ($row = 0; $row < 10; $row++) {
                $positions[] = Position::fromTopLeft($col, $row);
            }
        }

        for ($col = 0; $col < 6; $col++) {
            for ($row = 0; $row < 4; $row++) {
                $positions[] = Position::fromBottomRight($col, $row, Version::V01->size());
            }
        }

        yield [
            BitMatrix::zeros(Version::V01->size()),
            $positions,
            '            █  █  █  ' . PHP_EOL .
            '           █  █  █  █' . PHP_EOL .
            '          █  █  █  █ ' . PHP_EOL .
            '            █  █  █  ' . PHP_EOL .
            '           █  █  █  █' . PHP_EOL .
            '          █  █  █  █ ' . PHP_EOL .
            '            █  █  █  ' . PHP_EOL .
            '           █  █  █  █' . PHP_EOL .
            '          █  █  █  █ ' . PHP_EOL .
            '            █  █  █  ' . PHP_EOL .
            '  █  █  █  █  █  █  █' . PHP_EOL .
            ' █  █  █  █  █  █  █ ' . PHP_EOL .
            '█  █  █  █  █  █  █  ' . PHP_EOL .
            '  █  █  █  █  █  █  █' . PHP_EOL .
            ' █  █  █  █  █  █  █ ' . PHP_EOL .
            '█  █  █  █  █  █  █  ' . PHP_EOL .
            '  █  █  █  █  █  █  █' . PHP_EOL .
            ' █  █  █  █  █       ' . PHP_EOL .
            '█  █  █  █  █        ' . PHP_EOL .
            '  █  █  █  █  █      ' . PHP_EOL .
            ' █  █  █  █  █       ' . PHP_EOL,


        ];

        yield [
            BitMatrix::ones(Version::V01->size()),
            $positions,
            '████████████ ██ ██ ██' . PHP_EOL .
            '███████████ ██ ██ ██ ' . PHP_EOL .
            '██████████ ██ ██ ██ █' . PHP_EOL .
            '████████████ ██ ██ ██' . PHP_EOL .
            '███████████ ██ ██ ██ ' . PHP_EOL .
            '██████████ ██ ██ ██ █' . PHP_EOL .
            '████████████ ██ ██ ██' . PHP_EOL .
            '███████████ ██ ██ ██ ' . PHP_EOL .
            '██████████ ██ ██ ██ █' . PHP_EOL .
            '████████████ ██ ██ ██' . PHP_EOL .
            '██ ██ ██ ██ ██ ██ ██ ' . PHP_EOL .
            '█ ██ ██ ██ ██ ██ ██ █' . PHP_EOL .
            ' ██ ██ ██ ██ ██ ██ ██' . PHP_EOL .
            '██ ██ ██ ██ ██ ██ ██ ' . PHP_EOL .
            '█ ██ ██ ██ ██ ██ ██ █' . PHP_EOL .
            ' ██ ██ ██ ██ ██ ██ ██' . PHP_EOL .
            '██ ██ ██ ██ ██ ██ ██ ' . PHP_EOL .
            '█ ██ ██ ██ ██ ███████' . PHP_EOL .
            ' ██ ██ ██ ██ ████████' . PHP_EOL .
            '██ ██ ██ ██ ██ ██████' . PHP_EOL .
            '█ ██ ██ ██ ██ ███████' . PHP_EOL,

        ];
    }
}
