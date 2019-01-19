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
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ClassCommandHandlerMakerSubscriber implements ClassCommandHandlerMakerSubscriberInterface, EventSubscriberInterface
{

    public function create(CommandWasCreated $commandWasCreated)
    {
        // TODO: Implement create() method.
    }

    public static function getSubscribedEvents()
    {
        return [CommandWasCreated::NAME => 'create'];
    }
}