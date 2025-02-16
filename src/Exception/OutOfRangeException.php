<?php

namespace ThePhpGuild\QrCode\Exception;

class OutOfRangeException extends \Exception
{
    /**
     * @throws OutOfRangeException
     */
    public static function ensureWithinRange(int $value, array $limits): void
    {
        if ($value < $limits[0] || $value > $limits[1]) {
            throw new self($value, $limits);
        }
    }

    public function __construct(int $value, array $limits, int $code = 0, ?\Throwable $previous = null)
    {
        $strLimits = implode(', ', $limits);
        parent::__construct("$value out of range [${strLimits}]", $code, $previous);
    }
}
