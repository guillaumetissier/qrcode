#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use ThePhpGuild\QrCode\Commands\GenerateQrCodeCommand;

$application = new Application();
$application->add(new GenerateQrCodeCommand());
$application->run();
