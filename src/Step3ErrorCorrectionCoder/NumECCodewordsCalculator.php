<?php

namespace ThePhpGuild\QrCode\Step3ErrorCorrectionCoder;

use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Exception\VariableNotSetException;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class NumECCodewordsCalculator
{
    private ?ErrorCorrectionLevel $errorCorrectionLevel = null;
    private ?Version $version = null;

    public function __construct(private readonly IOLoggerInterface $logger)
    {
    }

    public function setErrorCorrectionLevel(?ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;

        return $this;
    }

    public function setVersion(?Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @throws VariableNotSetException
     */
    public function calculate(): int
    {
        if (!$this->errorCorrectionLevel) {
            throw new VariableNotSetException('errorCorrectionLevel');
        }

        if (!$this->version) {
            throw new VariableNotSetException('version');
        }

        $this->logger->input(
            "Version = {$this->version->value}, ECL = {$this->errorCorrectionLevel->value}",
            ['class' => static::class]
        );

        $numEcCodewordsCount = [
            1 =>  ['L' => 7,   'M' => 10,  'Q' => 13,  'H' => 17],
            2 =>  ['L' => 10,  'M' => 16,  'Q' => 22,  'H' => 28],
            3 =>  ['L' => 15,  'M' => 26,  'Q' => 36,  'H' => 44],
            4 =>  ['L' => 20,  'M' => 36,  'Q' => 52,  'H' => 64],
            5 =>  ['L' => 26,  'M' => 48,  'Q' => 72,  'H' => 88],
            6 =>  ['L' => 36,  'M' => 64,  'Q' => 96,  'H' => 112],
            7 =>  ['L' => 40,  'M' => 72,  'Q' => 108, 'H' => 130],
            8 =>  ['L' => 48,  'M' => 88,  'Q' => 132, 'H' => 156],
            9 =>  ['L' => 60,  'M' => 110, 'Q' => 160, 'H' => 192],
            10 => ['L' => 72,  'M' => 130, 'Q' => 192, 'H' => 224],
            11 => ['L' => 80,  'M' => 150, 'Q' => 224, 'H' => 264],
            12 => ['L' => 96,  'M' => 176, 'Q' => 260, 'H' => 308],
            13 => ['L' => 104, 'M' => 198, 'Q' => 288, 'H' => 352],
            14 => ['L' => 120, 'M' => 216, 'Q' => 320, 'H' => 384],
            15 => ['L' => 132, 'M' => 240, 'Q' => 360, 'H' => 432],
            16 => ['L' => 144, 'M' => 280, 'Q' => 408, 'H' => 480],
            17 => ['L' => 168, 'M' => 308, 'Q' => 448, 'H' => 532],
            18 => ['L' => 180, 'M' => 338, 'Q' => 504, 'H' => 588],
            19 => ['L' => 196, 'M' => 364, 'Q' => 546, 'H' => 650],
            20 => ['L' => 224, 'M' => 416, 'Q' => 600, 'H' => 700],
            21 => ['L' => 224, 'M' => 442, 'Q' => 644, 'H' => 750],
            22 => ['L' => 252, 'M' => 476, 'Q' => 690, 'H' => 816],
            23 => ['L' => 270, 'M' => 504, 'Q' => 750, 'H' => 900],
            24 => ['L' => 300, 'M' => 560, 'Q' => 810, 'H' => 960],
            25 => ['L' => 312, 'M' => 588, 'Q' => 870, 'H' => 1050],
            26 => ['L' => 336, 'M' => 644, 'Q' => 952, 'H' => 1110],
            27 => ['L' => 360, 'M' => 700, 'Q' => 1020, 'H' => 1200],
            28 => ['L' => 390, 'M' => 728, 'Q' => 1050, 'H' => 1260],
            29 => ['L' => 420, 'M' => 784, 'Q' => 1140, 'H' => 1350],
            30 => ['L' => 450, 'M' => 812, 'Q' => 1200, 'H' => 1440],
            31 => ['L' => 480, 'M' => 868, 'Q' => 1290, 'H' => 1530],
            32 => ['L' => 510, 'M' => 924, 'Q' => 1350, 'H' => 1620],
            33 => ['L' => 540, 'M' => 980, 'Q' => 1440, 'H' => 1710],
            34 => ['L' => 570, 'M' => 1036, 'Q' => 1530, 'H' => 1800],
            35 => ['L' => 570, 'M' => 1064, 'Q' => 1590, 'H' => 1890],
            36 => ['L' => 600, 'M' => 1120, 'Q' => 1680, 'H' => 1980],
            37 => ['L' => 630, 'M' => 1204, 'Q' => 1770, 'H' => 2100],
            38 => ['L' => 660, 'M' => 1260, 'Q' => 1860, 'H' => 2220],
            39 => ['L' => 720, 'M' => 1316, 'Q' => 1950, 'H' => 2310],
            40 => ['L' => 750, 'M' => 1372, 'Q' => 2040, 'H' => 2430],
        ][$this->version->value][$this->errorCorrectionLevel->value];

        $this->logger->output("Num EC Codewords = $numEcCodewordsCount", ['class' => static::class]);

        return $numEcCodewordsCount;
    }
}
