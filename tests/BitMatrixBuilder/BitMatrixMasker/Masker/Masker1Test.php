<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\BitMatrixMasker\Masker;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\Masker1;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\MaskerInterface;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;

class Masker1Test extends MaskerTestCase
{
    protected function createMasker(): MaskerInterface
    {
        return new Masker1();
    }

    public static function dataMask(): \Generator
    {

        yield [
            BitMatrix::zeros(Version::V01->size()),
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL,
        ];

        yield [
            BitMatrix::ones(Version::V01->size()),
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '                     ' . PHP_EOL,
        ];
    }

    public static function dataMaskWithFunctionPatternPositions(): \Generator
    {
        $positions = [];
        foreach ([5, 17, 18] as $col) {
            for ($row = 0; $row < Version::V01->size(); $row++) {
                $positions[] = Position::fromTopLeft($col, $row);
            }
        }

        yield [
            BitMatrix::zeros(Version::V01->size()),
            $positions,
            '█████ ███████████  ██' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████ ███████████  ██' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████ ███████████  ██' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████ ███████████  ██' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████ ███████████  ██' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████ ███████████  ██' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████ ███████████  ██' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████ ███████████  ██' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████ ███████████  ██' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████ ███████████  ██' . PHP_EOL .
            '                     ' . PHP_EOL .
            '█████ ███████████  ██' . PHP_EOL,
        ];

        yield [
            BitMatrix::ones(Version::V01->size()),
            $positions,
            '     █           ██  ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '     █           ██  ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '     █           ██  ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '     █           ██  ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '     █           ██  ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '     █           ██  ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '     █           ██  ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '     █           ██  ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '     █           ██  ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '     █           ██  ' . PHP_EOL .
            '█████████████████████' . PHP_EOL .
            '     █           ██  ' . PHP_EOL,
        ];
    }
}
