<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter;

use ThePhpGuild\QrCode\DataEncoder\Mode\Mode;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\AlphanumericCciBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\ByteCciBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\NumericCciBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\AlphanumericEncodedDataBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\ByteEncodedDataBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\NumericEncodedDataBitsCounter;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class TotalBitsCounterBuilder
{
    public function __construct(private readonly IOLoggerInterface $logger)
    {
    }

    public function getTotalBitsCounter(Mode $mode): TotalBitsCounter
    {
        return match ($mode) {
            Mode::ALPHANUMERIC => new TotalBitsCounter(
                new AlphanumericCciBitsCounter($this->logger),
                new AlphanumericEncodedDataBitsCounter($this->logger)
            ),
            Mode::BYTE => new TotalBitsCounter(
                new ByteCciBitsCounter($this->logger),
                new ByteEncodedDataBitsCounter($this->logger)
            ),
            Mode::NUMERIC => new TotalBitsCounter(
                new NumericCciBitsCounter($this->logger),
                new NumericEncodedDataBitsCounter($this->logger)
            ),
        };
    }
}
