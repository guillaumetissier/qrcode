<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoder;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class ByteEncoder extends AbstractModeEncoder
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
        $length = strlen($this->data);

        $this->logger?->input("{$this->data} (length: {$length})", ['class' => self::class]);

        for ($i = 0; $i < $length; $i++) {
            $dataBitString->append(str_pad(decbin(ord($this->data[$i])), 8, '0', STR_PAD_LEFT));
        }

        $this->logger?->output($dataBitString->toString(), ['class' => self::class]);

        return $dataBitString;
    }
}
