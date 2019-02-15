<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 15/02/2019
 * Time: 10:38
 */

namespace Saci\Console;

use Saci\Console\Application\Commands\CommandHandlerMakerCommand;
use Saci\Console\Application\Commands\ModuleMakerCommand;
use Saci\Console\Infrastructure\Application\SymfonyEventAdapter;
use Saci\Console\Infrastructure\Domain\Services\AddingCommandInMappingSubscriber;
use Saci\Console\Infrastructure\Domain\Services\ClassCommandHandlerMakerSubscriber;
use Saci\Console\Infrastructure\Domain\Services\ClassCommandMakerSubscriber;
use Saci\Console\Infrastructure\Domain\Services\ClassMappingMakerSubscriber;
use Saci\Console\Infrastructure\Domain\Services\ClassServiceProviderMakerSubscriber;
use Saci\Console\Infrastructure\Domain\Services\ModuleMakerSubscriber;
use Symfony\Component\Console\Application;

class Console
{
    /**
     * @throws \Exception
     */
    public static function main()
    {
        SymfonyEventAdapter::getInstance()->addSubscriber(new ModuleMakerSubscriber());
        SymfonyEventAdapter::getInstance()->addSubscriber(new ClassMappingMakerSubscriber());
        SymfonyEventAdapter::getInstance()->addSubscriber(new ClassServiceProviderMakerSubscriber());
        SymfonyEventAdapter::getInstance()->addSubscriber(new ClassCommandMakerSubscriber());
        SymfonyEventAdapter::getInstance()->addSubscriber(new ClassCommandHandlerMakerSubscriber());
        SymfonyEventAdapter::getInstance()->addSubscriber(new AddingCommandInMappingSubscriber());

        $app = new Application('Saci Console', 'v0.0.1');
        $app->add(new ModuleMakerCommand());
        $app->add(new CommandHandlerMakerCommand());

        $app->run();
    }
}