<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Commands;

use Guillaumetissier\QrCode\Commands\Output\OutputOptions;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Exception\MissingOption;
use Guillaumetissier\QrCode\Exception\WrongValue;
use Guillaumetissier\QrCode\Logger\ConsoleLogger;
use Guillaumetissier\QrCode\QrCodeGenerator;
use Psr\Log\LogLevel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateQrCodeCommand extends Command
{
    protected static $defaultName = 'app:generate-qrcode';

    protected function configure(): void
    {
        $this
            ->addOption('text', 'T', InputOption::VALUE_REQUIRED, 'Text to encode and to convert into a QR code')
            ->addOption('output', 'O', InputOption::VALUE_OPTIONAL, 'Name of the file to save the QR code image')
            ->addOption('ecl', 'E', InputOption::VALUE_REQUIRED, 'Error correction level [L, M, H, Q]', ErrorCorrectionLevel::MEDIUM->value)
            ->addOption('logLevel', 'L', InputOption::VALUE_OPTIONAL, 'desc', LogLevel::WARNING)
            ->addOption('scale', 'S', InputOption::VALUE_OPTIONAL, 'Scale of the image', 1)
            ->addOption('quality', 'Q', InputOption::VALUE_OPTIONAL, 'Quality of the image [0-100]', 80)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $consoleLogger = new ConsoleLogger();

        try {
            [$text, $output, $ecl, $logLevel] = $this->extractOptions($input);

            QrCodeGenerator::create($consoleLogger, $logLevel)
                ->withData($text)
                ->withErrorCorrectionLevel(ErrorCorrectionLevel::from($ecl))
                ->withOutputOptions(new OutputOptions([
                    OutputOptions::FILENAME => $output,
                ]))
                ->generate()
            ;

            return Command::SUCCESS;
        } catch (\Throwable $throwable) {
            $consoleLogger->alert($throwable->getMessage() . PHP_EOL);
            return Command::FAILURE;
        }
    }

    /**
     * @param InputInterface $input
     * @return array<string>
     * @throws MissingOption
     * @throws WrongValue
     */
    private function extractOptions(InputInterface $input): array
    {
        if (!is_string($text = $input->getOption('text'))) {
            throw new MissingOption('text');
        }

        if (!is_string($output = $input->getOption('output'))) {
            throw new MissingOption('output');
        }

        if (!is_string($ecl = $input->getOption('ecl'))) {
            throw new MissingOption('ecl');
        }

        if (
            !in_array($ecl, [
            ErrorCorrectionLevel::LOW->value,
            ErrorCorrectionLevel::MEDIUM->value,
            ErrorCorrectionLevel::QUARTILE->value,
            ErrorCorrectionLevel::HIGH->value,
            ])
        ) {
            throw new WrongValue('ecl', $ecl);
        }

        if (!is_string($logLevel = $input->getOption('logLevel'))) {
            throw new MissingOption('logLevel');
        }

        if (
            !in_array($logLevel, [
            LogLevel::ALERT,
            LogLevel::CRITICAL,
            LogLevel::DEBUG,
            LogLevel::EMERGENCY,
            LogLevel::ERROR,
            LogLevel::INFO,
            LogLevel::NOTICE,
            LogLevel::WARNING,
            ])
        ) {
            throw new WrongValue('logLevel', $logLevel);
        }

        return [$text, $output, $ecl, $logLevel];
    }
}
