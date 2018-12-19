<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 11/12/2018
 * Time: 12:42
 */

namespace Saci\Console\Infrastructure\Domain\Services;


use Saci\Console\Domain\Events\ModuleWasCreated;
use Saci\Console\Domain\Services;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ModuleMakerSubscriber implements Services\ModuleMakerSubscriber, EventSubscriberInterface
{

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [ModuleWasCreated::NAME => 'createModule'];
    }

    /**
     * @param ModuleWasCreated $created
     * @throws \Saci\Console\Domain\Exceptions\ModuleAlreadyExists
     */
    public function createModule(ModuleWasCreated $created)
    {
        ModuleMakerFactory::create()->make($created->getModule());
    }
}