<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Commands;

use Guillaumetissier\PathUtilities\Path;
use Guillaumetissier\QrCode\Commands\Output\OutputOptions;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Exception\MissingOption;
use Guillaumetissier\QrCode\Exception\InvalidInput;
use Guillaumetissier\QrCode\Logger\ConsoleLogger;
use Guillaumetissier\QrCode\Logger\LevelFilteredLogger;
use Guillaumetissier\QrCode\QrCodeGenerator;
use Psr\Log\LogLevel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class GenerateQrCodeCommand extends Command
{
    protected static $defaultName = 'app:generate-qrcode';

    protected function configure(): void
    {
        $this
            ->addOption('txt', 'T', InputOption::VALUE_REQUIRED, 'Text to encode and to convert into a QR code')
            ->addOption('out', 'O', InputOption::VALUE_OPTIONAL, 'Name of the file to save the QR code image')
            ->addOption('log', 'L', InputOption::VALUE_OPTIONAL, 'Level of logs to display', LogLevel::WARNING)
            ->addOption('scale', 'S', InputOption::VALUE_OPTIONAL, 'Scale of the image [1-20]', 10)
            ->addOption('quality', 'Q', InputOption::VALUE_OPTIONAL, 'Quality of the image [1-100]', 80)
            ->addOption(
                'ecl',
                'E',
                InputOption::VALUE_OPTIONAL,
                'Error correction level [L, M, H, Q]',
                ErrorCorrectionLevel::MEDIUM->value
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $consoleLogger = new ConsoleLogger();

        try {
            QrCodeGenerator::create($consoleLogger, $this->extractLogLevel($input))
                ->withData($this->extractText($input))
                ->withErrorCorrectionLevel(ErrorCorrectionLevel::from($this->extractEcl($input)))
                ->withOutputOptions(new OutputOptions([
                    OutputOptions::FILENAME => $this->extractOutput($input),
                    OutputOptions::SCALE => $this->extractScale($input),
                    OutputOptions::QUALITY => $this->extractQuality($input),
                ]))
                ->generate()
            ;

            return Command::SUCCESS;
        } catch (\Throwable $throwable) {
            $consoleLogger->alert($throwable->getMessage());
            echo PHP_EOL;
            return Command::FAILURE;
        }
    }

    /**
     * @param InputInterface $input
     * @return string
     * @throws MissingOption
     */
    private function extractText(InputInterface $input): string
    {
        if (!is_string($text = $input->getOption('txt'))) {
            throw new MissingOption('txt');
        }

        return $text;
    }

    /**
     * @param InputInterface $input
     * @return string
     * @throws MissingOption|InvalidInput
     */
    private function extractOutput(InputInterface $input): string
    {
        if (!is_string($output = $input->getOption('out'))) {
            throw new MissingOption('out');
        }

        $path = new Path($output);
        $dir = $path->parent();

        if (!$dir->exists() || !$dir->permissions()->isWritable()) {
             throw InvalidInput::invalidPath($dir);
        }

        return "$path";
    }

    /**
     * @param InputInterface $input
     * @return string
     * @throws MissingOption
     * @throws InvalidInput
     */
    private function extractLogLevel(InputInterface $input): string
    {
        if (!is_string($logLevel = $input->getOption('log'))) {
            throw new MissingOption('log');
        }

        if (!in_array($logLevel, LevelFilteredLogger::LOG_LEVELS)) {
            throw InvalidInput::notInSet('log', $logLevel, LevelFilteredLogger::LOG_LEVELS);
        }

        return $logLevel;
    }

    /**
     * @param InputInterface $input
     * @return int
     * @throws InvalidInput
     */
    private function extractScale(InputInterface $input): int
    {
        $scale = $input->getOption('scale');

        if (!is_numeric($scale)) {
            throw InvalidInput::notNumeric('scale');
        }

        $scale = (int) $scale;

        if ($scale < 1 || $scale > 20) {
            throw InvalidInput::outOfRange('scale', $scale, 1, 20);
        }

        return $scale;
    }

    /**
     * @param InputInterface $input
     * @return int
     * @throws InvalidInput
     */
    private function extractQuality(InputInterface $input): int
    {
        $quality = $input->getOption('quality');

        if (!is_numeric($quality)) {
            throw InvalidInput::notNumeric('quality');
        }

        $quality = (int) $quality;

        if ($quality < 1 || $quality > 100) {
            throw InvalidInput::outOfRange('quality', $quality, 1, 100);
        }

        return $quality;
    }

    /**
     * @param InputInterface $input
     * @return string
     * @throws MissingOption
     * @throws InvalidInput
     */
    private function extractEcl(InputInterface $input): string
    {
        if (!is_string($ecl = $input->getOption('ecl'))) {
            throw new MissingOption('ecl');
        }

        if (!in_array($ecl, ErrorCorrectionLevel::all())) {
            throw InvalidInput::notInSet('ecl', $ecl, ErrorCorrectionLevel::all());
        }

        return $ecl;
    }
}
