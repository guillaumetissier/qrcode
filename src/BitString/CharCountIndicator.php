<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Common\DataDependentTrait;
use Guillaumetissier\QrCode\Common\ModeDependentTrait;
use Guillaumetissier\QrCode\Common\VersionDependentTrait;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class CharCountIndicator implements CharCountIndicatorInterface
{
    use VersionDependentTrait;
    use ModeDependentTrait;
    use DataDependentTrait;

    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self($logger);
    }

    private function __construct(private readonly ?IOLoggerInterface $logger = null)
    {
    }

    private function __clone()
    {
    }

    /**
     * @throws MissingInfoException
     */
    public function bitString(): BitStringInterface
    {
        $mode = $this->mode();
        $version = $this->version();
        $data = $this->data();

        $this->logger?->input(
            [
                'Mode' => $mode,
                'Version' => $version,
                'data size' => strlen($data),
            ],
            [
                'class' => self::class,
            ]
        );

        if ($version->value <= 9) {
            $biCount = [
                Mode::NUMERIC->value => 10,
                Mode::ALPHANUMERIC->value => 9,
                Mode::BYTE->value => 8
            ][$mode->value];
        } elseif ($version->value <= 26) {
            $biCount = [
                Mode::NUMERIC->value => 12,
                Mode::ALPHANUMERIC->value => 11,
                Mode::BYTE->value => 16
            ][$mode->value];
        } else {
            $biCount = [
                Mode::NUMERIC->value => 14,
                Mode::ALPHANUMERIC->value => 13,
                Mode::BYTE->value => 16
            ][$mode->value];
        }

        $cci = BitStringImmutable::fromString(str_pad(decbin(strlen($data)), $biCount, '0', STR_PAD_LEFT));

        $this->logger?->output("Cci = {$cci}", ['class' => self::class]);

        return $cci;
    }
}
