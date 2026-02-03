<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Commands\Output;

use Guillaumetissier\QrCode\BitMatrixPainter\File\FileType;

interface OutputOptionsInterface
{
    public function contentType(): ?string;

    public function filename(): ?string;

    public function fileType(): FileType;

    public function quality(): int;

    public function scale(): int;
}
