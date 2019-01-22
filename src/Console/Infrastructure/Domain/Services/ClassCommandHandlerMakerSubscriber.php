<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 17/01/2019
 * Time: 20:18
 */

namespace Saci\Console\Infrastructure\Domain\Services;


use Saci\Console\Domain\Events\CommandWasCreated;
use Saci\Console\Domain\Services\ClassCommandHandlerMakerSubscriber as ClassCommandHandlerMakerSubscriberInterface;
use Saci\Console\Infrastructure\Domain\Services\PhpClass\CommandHandler;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;

class ClassCommandHandlerMakerSubscriber implements ClassCommandHandlerMakerSubscriberInterface, EventSubscriberInterface
{

    public function create(CommandWasCreated $commandWasCreated)
    {
        $classMaker = new CommandHandlerClassMaker($commandWasCreated->getCommand());
        $generateable = $classMaker->generate(new CommandHandler());
        $stringClass = GeneratorClassFactory::create()->generate($generateable);

        $stringClass = "<?php\n" . $stringClass;

        (new Filesystem())->dumpFile(
            $commandWasCreated->getCommand()->getLocalFileCommandHandler(),
            $stringClass
        );

        return true;
    }

    public static function getSubscribedEvents()
    {
        return [CommandWasCreated::NAME => 'create'];
    }
}