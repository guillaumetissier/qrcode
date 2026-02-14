<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Commands;

use Guillaumetissier\QrCode\Commands\Output\OutputOptions;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Exception\MissingOption;
use Guillaumetissier\QrCode\Exception\WrongValue;
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
            $options = $this->extractOptions($input);

            QrCodeGenerator::create($consoleLogger, $options['log'])
                ->withData($options['txt'])
                ->withErrorCorrectionLevel(ErrorCorrectionLevel::from($options['ecl']))
                ->withOutputOptions(new OutputOptions([
                    OutputOptions::FILENAME => $options['out'],
                    OutputOptions::SCALE => $options['scale'],
                    OutputOptions::QUALITY => $options['quality'],
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
     * @return array{
     *     txt: string,
     *     out: string,
     *     log: string,
     *     scale: int,
     *     quality: int,
     *     ecl: string
     * }
     * @throws MissingOption
     * @throws WrongValue
     */
    private function extractOptions(InputInterface $input): array
    {
        if (!is_string($text = $input->getOption('txt'))) {
            throw new MissingOption('txt');
        }

        if (!is_string($output = $input->getOption('out'))) {
            throw new MissingOption('out');
        }

        if (!is_string($logLevel = $input->getOption('log'))) {
            throw new MissingOption('log');
        }

        if (!in_array($logLevel, LevelFilteredLogger::LOG_LEVELS)) {
            throw WrongValue::notInSet('log', $logLevel, LevelFilteredLogger::LOG_LEVELS);
        }

        $scale = $input->getOption('scale');

        if (!is_numeric($scale)) {
            throw WrongValue::notNumeric('scale');
        }

        $scale = (int) $scale;

        if ($scale < 1 || $scale > 20) {
            throw WrongValue::outOfRange('scale', $scale, 1, 20);
        }

        $quality = $input->getOption('quality');

        if (!is_numeric($quality)) {
            throw WrongValue::notNumeric('quality');
        }

        $quality = (int) $quality;

        if ($quality < 1 || $quality > 100) {
            throw WrongValue::outOfRange('quality', $quality, 1, 100);
        }

        if (!is_string($ecl = $input->getOption('ecl'))) {
            throw new MissingOption('ecl');
        }

        if (!in_array($ecl, ErrorCorrectionLevel::all())) {
            throw WrongValue::notInSet('ecl', $ecl, ErrorCorrectionLevel::all());
        }

        return [
            'txt' => $text,
            'out' => $output,
            'log' => $logLevel,
            'scale' => $scale,
            'quality' => $quality,
            'ecl' => $ecl
        ];
    }
}
