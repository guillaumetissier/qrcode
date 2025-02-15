<?php

namespace ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter;

use ThePhpGuild\Qrcode\DataEncoder\Mode\Mode;
use ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\AlphanumericCciBitsCounter;
use ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\ByteCciBitsCounter;
use ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\NumericCciBitsCounter;
use ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\AlphanumericEncodedDataBitsCounter;
use ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\ByteEncodedDataBitsCounter;
use ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\NumericEncodedDataBitsCounter;

class TotalBitsCounterBuilder
{
    public function getTotalBitsCounter(Mode $mode): TotalBitsCounter
    {
        return match ($mode) {
            Mode::ALPHANUMERIC => new TotalBitsCounter(
                new AlphanumericCciBitsCounter(),
                new AlphanumericEncodedDataBitsCounter()
            ),
            Mode::BYTE => new TotalBitsCounter(
                new ByteCciBitsCounter(),
                new ByteEncodedDataBitsCounter()
            ),
            Mode::NUMERIC => new TotalBitsCounter(
                new NumericCciBitsCounter(),
                new NumericEncodedDataBitsCounter()
            ),
        };
    }
}
