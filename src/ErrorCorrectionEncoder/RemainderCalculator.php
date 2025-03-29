<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder;

use ThePhpGuild\QrCode\Exception\OutOfRangeException;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class RemainderCalculator
{
    public function __construct(
        private readonly GalloisField $galloisField,
        private readonly IOLoggerInterface $logger
    )
    {
    }

    /**
     * @throws OutOfRangeException
     */
    public function calculate(array $data, array $generator): array
    {
        $this->logger->input("Data " . implode($data), ['class' => static::class]);

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

        $this->logger->output('Remainder = ' . implode('|', $remainder), ['class' => static::class]);

        return $remainder;
    }
}
