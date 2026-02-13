# QR Code Generator

A pure PHP library for generating QR codes, supporting multiple output formats (PNG, JPG, GIF, PDF) and console rendering. Built from scratch following the QR code specification.
_**Note**: "QR Code" is registered trademark of **[DENSO WAVE INCORPORATED](https://www.qrcode.com/en/)**._

## Requirements

- PHP 8.1+
- GD extension (for image output)
- [TCPDF](https://tcpdf.org/) (for PDF output)
- [Symfony Console](https://symfony.com/doc/current/components/console.html) (for CLI usage)

## Installation

```bash
composer require guillaumetissier/qrcode
```

## Usage

### Programmatic API

```php
use Guillaumetissier\QrCode\QrCodeGenerator;
use Guillaumetissier\QrCode\Commands\Output\OutputOptions;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

// Generate a QR code and save it to a file
QrCodeGenerator::create()
    ->withData('https://example.com')
    ->withErrorCorrectionLevel(ErrorCorrectionLevel::MEDIUM)
    ->withOutputOptions(new OutputOptions([
        OutputOptions::FILENAME => 'qrcode.png',
        OutputOptions::SCALE    => 10,
        OutputOptions::QUALITY  => 80,
    ]))
    ->generate();
```

### With a Logger (PSR-3)

```php
use Guillaumetissier\QrCode\QrCodeGenerator;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Psr\Log\LogLevel;

$logger = new Logger('qrcode');
$logger->pushHandler(new StreamHandler('php://stdout'));

QrCodeGenerator::create($logger, LogLevel::DEBUG)
    ->withData('Hello World')
    ->withErrorCorrectionLevel(ErrorCorrectionLevel::HIGH)
    ->withOutputOptions(new OutputOptions([
        OutputOptions::FILENAME => 'qrcode.png',
    ]))
    ->generate();
```

### Output to browser (inline)

```php
use Guillaumetissier\QrCode\Commands\Output\OutputOptions;
use Guillaumetissier\QrCode\BitMatrixPainter\File\FileType;

QrCodeGenerator::create()
    ->withData('Hello World')
    ->withOutputOptions(new OutputOptions([
        OutputOptions::FILETYPE => FileType::PNG,
        OutputOptions::SCALE    => 10,
    ]))
    ->generate();
```

### CLI

```bash
php console.php app:generate-qrcode \
    --text="Hello World" \
    --output="qrcode.png" \
    --ecl=M \
    --scale=10 \
    --quality=80 \
    --logLevel=warning
```

#### CLI Options

| Option | Shortcut | Description | Default |
|--------|----------|-------------|---------|
| `--text` | `-T` | Text to encode (**required**) | — |
| `--output` | `-O` | Output filename (**required**) | — |
| `--ecl` | `-E` | Error correction level: `L`, `M`, `Q`, `H` | `M` |
| `--scale` | `-S` | Scale factor for the image (1–20) | `1` |
| `--quality` | `-Q` | Image quality for JPG (1–100) | `80` |
| `--logLevel` | `-L` | PSR-3 log level | `warning` |

## Configuration

### Error Correction Levels

| Level | Value | Description | Data recovery |
|-------|-------|-------------|---------------|
| `LOW` | `L` | Smallest QR code | ~7% |
| `MEDIUM` | `M` | Balanced *(default)* | ~15% |
| `QUARTILE` | `Q` | More robust | ~25% |
| `HIGH` | `H` | Most robust | ~30% |

### Output Formats

| Format | Enum | MIME type |
|--------|------|-----------|
| PNG | `FileType::PNG` | `image/png` |
| JPEG | `FileType::JPG` | `image/jpeg` |
| GIF | `FileType::GIF` | `image/gif` |
| PDF | `FileType::PDF` | `application/pdf` |

### OutputOptions parameters

| Constant | Type | Description | Default |
|----------|------|-------------|---------|
| `FILENAME` | `string` | Path to output file | `null` |
| `FILETYPE` | `FileType` | File type for browser output | `null` |
| `SCALE` | `int` | Module size in pixels (1–20) | `10` |
| `QUALITY` | `int` | JPEG quality (1–100) | `80` |

Either `FILENAME` or `FILETYPE` must be provided, but not both.

## Supported Encoding Modes

The library automatically detects the most efficient encoding mode for the input data:

- **Numeric** — digits only (`0–9`)
- **Alphanumeric** — digits, uppercase letters and a few symbols (` $%*+-./:`)
- **Byte** — arbitrary binary data (UTF-8 text, URLs, etc.)

## Supported Versions

Versions 1 to 40 are supported, automatically selected based on data length and error correction level. Each version corresponds to a matrix size from 21×21 (V1) to 177×177 (V40).

## Architecture

The generation pipeline is composed of three main stages:

```
Data (string)
    │
    ▼
┌─────────────────────────────────┐
│  Encoder                        │
│  - Mode detection               │
│  - Version selection            │
│  - Data encoding                │
│  - Error correction calculation │
│  - Final codewords assembly     │
└────────────────┬────────────────┘
                 │ BitString
                 ▼
┌─────────────────────────────────┐
│  BitMatrixBuilder               │
│  - Function patterns placement  │
│  - Data codewords placement     │
│  - Masking (8 patterns)         │
│  - Penalty score evaluation     │
│  - Format/Version info modules  │
└────────────────┬────────────────┘
                 │ BitMatrix
                 ▼
┌─────────────────────────────────┐
│  BitMatrixPainter               │
│  - Image (GD), PDF (TCPDF)      │
│  - Console (ASCII)              │
└─────────────────────────────────┘
```

## Running Tests

```bash
composer test
# or
vendor/bin/phpunit
```

## Static Analysis

```bash
composer stan # level max
#or
vendor/bin/phpstan analyse
```

## License

MIT