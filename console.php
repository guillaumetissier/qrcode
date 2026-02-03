#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Guillaumetissier\QrCode\Commands\GenerateQrCodeCommand;

$application = new Application();
$application->add(new GenerateQrCodeCommand());
$application->run();
