<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder;

use ThePhpGuild\QrCode\Exception\OutOfRangeException;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

class RemainderCalculator
{
    public function __construct(
        private readonly GalloisField $galloisField,
        private readonly LevelFilteredLogger $logger
    )
    {
        $this->logger->setPrefix(self::class);
    }

    /**
     * @throws OutOfRangeException
     */
    public function calculate(array $data, array $generator): array
    {
        $this->logger->input("Data " . implode($data));

        $dataLength = count($data);
        $genLength = count($generator);

        for ($i = 0; $i < $dataLength - ($genLength - 1); $i++) {
            $coefficient = $data[$i];
            if ($coefficient != 0) {
                for ($j = 0; $j < $genLength; $j++) {
                    $data[$i + $j] = $this->galloisField->add(
                        $data[$i + $j],
                        $this->galloisField->multiply($generator[$j], $coefficient)
                    );
                }
            }
        }

        $remainder = array_slice($data, -($genLength - 1));

        $this->logger->output('Remainder = ' . implode('|', $remainder));

        return $remainder;
    }
}
