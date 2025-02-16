<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter;

use ThePhpGuild\QrCode\DataEncoder\Mode\Mode;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\AlphanumericCciBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\ByteCciBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\NumericCciBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\AlphanumericEncodedDataBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\ByteEncodedDataBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\NumericEncodedDataBitsCounter;

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
