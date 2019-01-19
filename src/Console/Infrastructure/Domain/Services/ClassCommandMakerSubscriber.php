<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 17/01/2019
 * Time: 20:18
 */

namespace Saci\Console\Infrastructure\Domain\Services;


use Saci\Console\Domain\Events\CommandWasCreated;
use Saci\Console\Infrastructure\Domain\Services\PhpClass\Command;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;

class ClassCommandMakerSubscriber implements \Saci\Console\Domain\Services\ClassCommandMakerSubscriber, EventSubscriberInterface
{

    public function create(CommandWasCreated $commandWasCreated)
    {
        $classMaker = new CommandClassMaker($commandWasCreated->getCommand());
        $generateable = $classMaker->generate(new Command());
        $stringClass = GeneratorClassFactory::create()->generate($generateable);

        $stringClass = "<?php\n" . $stringClass;

        (new Filesystem())->dumpFile(
            $commandWasCreated->getCommand()->getLocalFileCommand(),
            $stringClass
        );

        return true;
    }

    public static function getSubscribedEvents()
    {
        return [CommandWasCreated::NAME => 'create'];
    }
}