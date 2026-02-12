<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\BitMatrixMasker\Masker;

use Generator;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\Masker4;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\Masker5;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\Masker6;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\MaskerInterface;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;

final class Masker6Test extends MaskerTestCase
{
    protected function createMasker(): MaskerInterface
    {
        return new Masker6();
    }

    public static function dataMask(): Generator
    {
        yield [
            BitMatrix::zeros(Version::V01->size()),
            '█████████████████████' . PHP_EOL .
            '███   ███   ███   ███' . PHP_EOL .
            '██ ██ ██ ██ ██ ██ ██ ' . PHP_EOL .
            '█ █ █ █ █ █ █ █ █ █ █' . PHP_EOL .
            '█ ██ ██ ██ ██ ██ ██ █' . PHP_EOL .
            '█   ███   ███   ███  ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '███   ███   ███   ███' . PHP_EOL .
            '██ ██ ██ ██ ██ ██ ██ ' . PHP_EOL .
            '█ █ █ █ █ █ █ █ █ █ █' . PHP_EOL .
            '█ ██ ██ ██ ██ ██ ██ █' . PHP_EOL .
            '█   ███   ███   ███  ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '███   ███   ███   ███' . PHP_EOL .
            '██ ██ ██ ██ ██ ██ ██ ' . PHP_EOL .
            '█ █ █ █ █ █ █ █ █ █ █' . PHP_EOL .
            '█ ██ ██ ██ ██ ██ ██ █' . PHP_EOL .
            '█   ███   ███   ███  ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '███   ███   ███   ███' . PHP_EOL .
            '██ ██ ██ ██ ██ ██ ██ ' . PHP_EOL,
        ];

        yield [
            BitMatrix::ones(Version::V01->size()),
            '                     ' . PHP_EOL .
            '   ███   ███   ███   ' . PHP_EOL .
            '  █  █  █  █  █  █  █' . PHP_EOL .
            ' █ █ █ █ █ █ █ █ █ █ ' . PHP_EOL .
            ' █  █  █  █  █  █  █ ' . PHP_EOL .
            ' ███   ███   ███   ██' . PHP_EOL .
            '                     ' . PHP_EOL .
            '   ███   ███   ███   ' . PHP_EOL .
            '  █  █  █  █  █  █  █' . PHP_EOL .
            ' █ █ █ █ █ █ █ █ █ █ ' . PHP_EOL .
            ' █  █  █  █  █  █  █ ' . PHP_EOL .
            ' ███   ███   ███   ██' . PHP_EOL .
            '                     ' . PHP_EOL .
            '   ███   ███   ███   ' . PHP_EOL .
            '  █  █  █  █  █  █  █' . PHP_EOL .
            ' █ █ █ █ █ █ █ █ █ █ ' . PHP_EOL .
            ' █  █  █  █  █  █  █ ' . PHP_EOL .
            ' ███   ███   ███   ██' . PHP_EOL .
            '                     ' . PHP_EOL .
            '   ███   ███   ███   ' . PHP_EOL .
            '  █  █  █  █  █  █  █' . PHP_EOL,
        ];
    }
    public static function dataMaskWithFunctionPatternPositions(): Generator
    {
        $positions = [];
        foreach ([2, 3, 4] as $row) {
            for ($col = 0; $col < Version::V01->size(); $col++) {
                $positions[] = Position::fromTopLeft($col, $row);
            }
        }

        yield [
            BitMatrix::zeros(Version::V01->size()),
            $positions,
            '█████████████████████' . PHP_EOL .
            '███   ███   ███   ███' . PHP_EOL .
            '                     ' . PHP_EOL .
            '                     ' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█   ███   ███   ███  ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '███   ███   ███   ███' . PHP_EOL .
            '██ ██ ██ ██ ██ ██ ██ ' . PHP_EOL .
            '█ █ █ █ █ █ █ █ █ █ █' . PHP_EOL .
            '█ ██ ██ ██ ██ ██ ██ █' . PHP_EOL .
            '█   ███   ███   ███  ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '███   ███   ███   ███' . PHP_EOL .
            '██ ██ ██ ██ ██ ██ ██ ' . PHP_EOL .
            '█ █ █ █ █ █ █ █ █ █ █' . PHP_EOL .
            '█ ██ ██ ██ ██ ██ ██ █' . PHP_EOL .
            '█   ███   ███   ███  ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '███   ███   ███   ███' . PHP_EOL .
            '██ ██ ██ ██ ██ ██ ██ ' . PHP_EOL,

        ];

        yield [
            BitMatrix::ones(Version::V01->size()),
            $positions,
            '                     ' . PHP_EOL .
            '   ███   ███   ███   ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            ' ███   ███   ███   ██' . PHP_EOL .
            '                     ' . PHP_EOL .
            '   ███   ███   ███   ' . PHP_EOL .
            '  █  █  █  █  █  █  █' . PHP_EOL .
            ' █ █ █ █ █ █ █ █ █ █ ' . PHP_EOL .
            ' █  █  █  █  █  █  █ ' . PHP_EOL .
            ' ███   ███   ███   ██' . PHP_EOL .
            '                     ' . PHP_EOL .
            '   ███   ███   ███   ' . PHP_EOL .
            '  █  █  █  █  █  █  █' . PHP_EOL .
            ' █ █ █ █ █ █ █ █ █ █ ' . PHP_EOL .
            ' █  █  █  █  █  █  █ ' . PHP_EOL .
            ' ███   ███   ███   ██' . PHP_EOL .
            '                     ' . PHP_EOL .
            '   ███   ███   ███   ' . PHP_EOL .
            '  █  █  █  █  █  █  █' . PHP_EOL,

        ];
    }
}
