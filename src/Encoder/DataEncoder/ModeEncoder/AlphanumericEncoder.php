<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoder;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class AlphanumericEncoder extends AbstractModeEncoder
{
    /**
     * @throws MissingInfoException
     */
    public function encode(): BitStringInterface
    {
        if ($this->data === null) {
            throw MissingInfoException::missingInfo('data', self::class);
        }

        $dataBitString = BitString::empty();
        $charMap = array_flip(str_split("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ $%*+-./:"));
        $length = strlen($this->data);

        $this->logger?->input("{$this->data} (length: {$length})", ['class' => self::class]);

        for ($i = 0; $i < $length; $i += 2) {
            $chunk = substr($this->data, $i, 2);
            if (strlen($chunk) == 2) {
                $value = $charMap[$chunk[0]] * 45 + $charMap[$chunk[1]];
                $dataBitString->append(str_pad(decbin($value), 11, '0', STR_PAD_LEFT));
            } else {
                $dataBitString->append(str_pad(decbin($charMap[$chunk[0]]), 6, '0', STR_PAD_LEFT));
            }
        }

        $this->logger?->output($dataBitString, ['class' => self::class]);

        return $dataBitString;
    }
}
