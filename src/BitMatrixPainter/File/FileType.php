<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixPainter\File;

enum FileType
{
    case GIF;
    case JPG;
    case PDF;
    case PNG;
}
