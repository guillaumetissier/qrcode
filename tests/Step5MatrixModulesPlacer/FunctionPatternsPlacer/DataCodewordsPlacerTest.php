<?php

namespace Tests\Step5MatrixModulesPlacer\FunctionPatternsPlacer;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer\DataCodewordsPlacer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\DataCodewordPositions;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\Position;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\PositionsInterface;

class DataCodewordsPlacerTest extends TestCase
{
    /**
     * @dataProvider provideDataToTestPlace
     */
    public function testPlace(int $size, array $alreadySetPositions, string $data, string $expectedMatrix): void
    {
        $matrix = new Matrix($size);
        $matrix->showValues();
        foreach ($alreadySetPositions as $position) {
            $matrix->setValueFromBottomRight($position, '.');
        }
        $dataCodewords = new DataCodewordsPlacer();
        $dataCodewords->setData($data)->setPositions((new DataCodewordPositions())->setSize($size))->place($matrix);

        $this->assertEquals($expectedMatrix, "$matrix");
    }

    public static function provideDataToTestPlace(): \Generator
    {
        yield [
            25,
            [],
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMN',
            'BA98JIxHGRQPOZYXW7654FEDC' . PHP_EOL .
            'DC76LKxFETSNM10VU9832HGBA' . PHP_EOL .
            'FE54NMxDCVULK32TSBA10JI98' . PHP_EOL .
            'HG32POxBAXWJI54RQDCZYLK76' . PHP_EOL .
            'JI10RQx98ZYHG76POFEXWNM54' . PHP_EOL .
            'LKZYTSx7610FE98NMHGVUPO32' . PHP_EOL .
            'NMXWVUx5432DCBALKJITSRQ10' . PHP_EOL .
            'POVUXWx3254BADCJILKRQTSZY' . PHP_EOL .
            'RQTSZYx107698FEHGNMPOVUXW' . PHP_EOL .
            'TSRQ10xZY9876HGFEPONMXWVU' . PHP_EOL .
            'VUPO32xXWBA54JIDCRQLKZYTS' . PHP_EOL .
            'XWNM54xVUDC32LKBATSJI10RQ' . PHP_EOL .
            'ZYLK76xTSFE10NM98VUHG32PO' . PHP_EOL .
            '10JI98xRQHGZYPO76XWFE54NM' . PHP_EOL .
            '32HGBAxPOJIXWRQ54ZYDC76LK' . PHP_EOL .
            '54FEDCxNMLKVUTS3210BA98JI' . PHP_EOL .
            '76DCFExLKNMTSVU103298BAHG' . PHP_EOL .
            '98BAHGxJIPORQXWZY5476DCFE' . PHP_EOL .
            'BA98JIxHGRQPOZYXW7654FEDC' . PHP_EOL .
            'DC76LKxFETSNM10VU9832HGBA' . PHP_EOL .
            'FE54NMxDCVULK32TSBA10JI98' . PHP_EOL .
            'HG32POxBAXWJI54RQDCZYLK76' . PHP_EOL .
            'JI10RQx98ZYHG76POFEXWNM54' . PHP_EOL .
            'LKZYTSx7610FE98NMHGVUPO32' . PHP_EOL .
            'NMXWVUx5432DCBALKJITSRQ10' . PHP_EOL
        ];

        yield [
            25,
            [
                new Position(0, 20), new Position(1, 20), new Position(2, 20), new Position(3, 20), new Position(4, 20),
                new Position(0, 21), new Position(1, 21), new Position(2, 21), new Position(3, 21), new Position(4, 21),
                new Position(0, 22), new Position(1, 22), new Position(2, 22), new Position(3, 22), new Position(4, 22),
                new Position(0, 23), new Position(1, 23), new Position(2, 23), new Position(3, 23), new Position(4, 23),
                new Position(0, 24), new Position(1, 24), new Position(2, 24), new Position(3, 24), new Position(4, 24),

                new Position(20, 0), new Position(21, 0), new Position(22, 0), new Position(23, 0), new Position(24, 0),
                new Position(20, 1), new Position(21, 1), new Position(22, 1), new Position(23, 1), new Position(24, 1),
                new Position(20, 2), new Position(21, 2), new Position(22, 2), new Position(23, 2), new Position(24, 2),
                new Position(20, 3), new Position(21, 3), new Position(22, 3), new Position(23, 3), new Position(24, 3),
                new Position(20, 4), new Position(21, 4), new Position(22, 4), new Position(23, 4), new Position(24, 4),

                new Position(20, 20), new Position(21, 20), new Position(22, 20), new Position(23, 20), new Position(24, 20),
                new Position(20, 21), new Position(21, 21), new Position(22, 21), new Position(23, 21), new Position(24, 21),
                new Position(20, 22), new Position(21, 22), new Position(22, 22), new Position(23, 22), new Position(24, 22),
                new Position(20, 23), new Position(21, 23), new Position(22, 23), new Position(23, 23), new Position(24, 23),
                new Position(20, 24), new Position(21, 24), new Position(22, 24), new Position(23, 24), new Position(24, 24),
            ],
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789ABCDEFGHIJKLMN',
            '.....TxSR210ZA987IHG.....' . PHP_EOL .
            '.....UxQP43YXCB65KJF.....' . PHP_EOL .
            '.....VxON65WVED43MLE.....' . PHP_EOL .
            '.....WxML87UTGF21OND.....' . PHP_EOL .
            '.....XxKJA9SRIH0ZQPC.....' . PHP_EOL .
            'SRQPZYxIHCBQPKJYXSRBA5432' . PHP_EOL .
            'UTON10xGFEDONMLWVUT987610' . PHP_EOL .
            'WVML32xEDGFMLONUTWV7698ZY' . PHP_EOL .
            'YXKJ54xCBIHKJQPSRYX54BAXW' . PHP_EOL .
            '0ZIH76xA9KJIHSRQP0Z32DCVU' . PHP_EOL .
            '21GF98x87MLGFUTON2110FETS' . PHP_EOL .
            '43EDBAx65ONEDWVML43ZYHGRQ' . PHP_EOL .
            '65CBDCx43QPCBYXKJ65XWJIPO' . PHP_EOL .
            '87A9FEx21SRA90ZIH87VULKNM' . PHP_EOL .
            'A987HGx0ZUT8721GFA9TSNMLK' . PHP_EOL .
            'CB65JIxYXWV6543EDCBRQPOJI' . PHP_EOL .
            'ED43LKxWVYX4365CBEDPORQHG' . PHP_EOL .
            'GF21NMxUT0Z2187A9GFNMTSFE' . PHP_EOL .
            'IH0ZPOxSR210ZA987IHLKVUDC' . PHP_EOL .
            'KJYXRQxQP43YXCB65KJJIXWBA' . PHP_EOL .
            '.....SxON65WVED43MLHGZY98' . PHP_EOL .
            '.....TxML87UTGF21ONFE1076' . PHP_EOL .
            '.....UxKJA9SRIH0ZQPDC3254' . PHP_EOL .
            '.....VxIHCBQPKJYXSRBA5432' . PHP_EOL .
            '.....WxGFEDONMLWVUT987610' . PHP_EOL
        ];
    }
}