<?php

use Saci\Console\Application\Commands\CommandHandlerMakerCommand;
use Saci\Console\Application\Commands\ModuleMakerCommand;
use Saci\Console\Infrastructure\Application\SymfonyEventAdapter;
use Saci\Console\Infrastructure\Domain\Services\ClassCommandHandlerMakerSubscriber;
use Saci\Console\Infrastructure\Domain\Services\ClassCommandMakerSubscriber;
use Saci\Console\Infrastructure\Domain\Services\ClassMappingMakerSubscriber;
use Saci\Console\Infrastructure\Domain\Services\ClassServiceProviderMakerSubscriber;
use Saci\Console\Infrastructure\Domain\Services\ModuleMakerSubscriber;
use Symfony\Component\Console\Application;

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'constans.php';
require_once __DIR__ . '/vendor/autoload.php';

SymfonyEventAdapter::getInstance()->addSubscriber(new ModuleMakerSubscriber());
SymfonyEventAdapter::getInstance()->addSubscriber(new ClassMappingMakerSubscriber());
SymfonyEventAdapter::getInstance()->addSubscriber(new ClassServiceProviderMakerSubscriber());
SymfonyEventAdapter::getInstance()->addSubscriber(new ClassCommandMakerSubscriber());
SymfonyEventAdapter::getInstance()->addSubscriber(new ClassCommandHandlerMakerSubscriber());

$app = new Application('Saci Console', 'v0.0.1');
$app->add(new ModuleMakerCommand());
$app->add(new CommandHandlerMakerCommand());

$app->run();
