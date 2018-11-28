#!/usr/bin/env php
<?php

use Saci\Console\Application\Commands\ModuleMakerCommand;
use Symfony\Component\Console\Application;

ini_set('display_errors',1);
error_reporting(E_ALL);

require_once 'constans.php';
require_once __DIR__ . '/vendor/autoload.php';

$app = new Application('Saci Console', 'v0.0.1');
$app->add(new ModuleMakerCommand());

$app->run();
