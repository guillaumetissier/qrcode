<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoder;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class NumericEncoder extends AbstractModeEncoder
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

        for ($i = 0; $i < $length; $i += 3) {
            $chunk = substr($this->data, $i, 3);
            $chunkBits = str_pad(decbin((int)$chunk), strlen($chunk) * 3 + 1, '0', STR_PAD_LEFT);
            $dataBitString->append($chunkBits);
        }

        $this->logger?->output($dataBitString->toString(), ['class' => self::class]);

        return $dataBitString;
    }
}
