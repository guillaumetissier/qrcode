<?php

namespace ThePhpGuild\QrCode\Commands;

use Psr\Log\LogLevel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Exception\MissingOption;
use ThePhpGuild\QrCode\Exception\WrongValue;
use ThePhpGuild\QrCode\Logger\ConsoleLogger;
use ThePhpGuild\QrCode\Matrix\Renderer\Output\OutputOptions;

class GenerateQrCodeCommand extends Command
{
    protected static $defaultName = 'app:generate-qrcode';

    protected function configure(): void
    {
        $this
            ->addOption('text', 'T', InputOption::VALUE_REQUIRED, 'Text to encode and to convert into a QR code')
            ->addOption('output', 'O', InputOption::VALUE_OPTIONAL, 'Name of the file to save the QR code image')
            ->addOption('ecl', 'E', InputOption::VALUE_REQUIRED, 'Error correction level [L, M, H, Q]' )
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

            QrCodeGenerator::getQrCodeGenerator($consoleLogger, $logLevel)
                ->setData($text)
                ->setErrorCorrectionLevel(ErrorCorrectionLevel::from($ecl))
                ->setOutputOptions(new OutputOptions([
                    OutputOptions::FILENAME => $output,
                ]))
                ->generate()
            ;

            return Command::SUCCESS;

        } catch (\Throwable $throwable) {
            $consoleLogger->alert($throwable->getMessage()) . PHP_EOL;
            return Command::FAILURE;
        }
    }

    /**
     * @throws MissingOption
     * @throws WrongValue
     */
    private function extractOptions(InputInterface $input): array
    {
        if (null === ($text = $input->getOption('text'))) {
            throw new MissingOption('text');
        }
        if (null === ($output = $input->getOption('output'))) {
            throw new MissingOption('output');
        }
        if (null === ($ecl = $input->getOption('ecl'))) {
            throw new MissingOption('ecl');
        } else if (!in_array($ecl, ['L', 'M', 'H', 'Q'])) {
            throw new WrongValue('ecl', $ecl);
        }
        $logLevel = str_replace('=', '', $input->getOption('logLevel'));

        return [$text, $output, $ecl, $logLevel];
    }
}
