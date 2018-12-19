<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 11/12/2018
 * Time: 18:14
 */

namespace Saci\Console\Infrastructure\Domain\Services;


use Saci\Console\Domain\Events\ModuleWasCreated;
use Saci\Console\Infrastructure\Domain\Services\PhpClass\Mapping;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;

class ClassMappingMakerSubscriber implements \Saci\Console\Domain\Services\ClassMappingMakerSubscriber, EventSubscriberInterface
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
        return [ModuleWasCreated::NAME => 'create'];
    }

    public function create(ModuleWasCreated $created)
    {
        $classMaker = new ClassMaker($created->getModule());
        $generateable = $classMaker->generate(new Mapping());
        $stringClass = GeneratorClassFactory::create()->generate($generateable);

        $stringClass = "<?php\n" . $stringClass;

        (new Filesystem())->dumpFile($created->getModule()->getPathModule() . DIRECTORY_SEPARATOR . 'Mapping.php', $stringClass);

        return true;
    }
}