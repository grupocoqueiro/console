<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 11/12/2018
 * Time: 13:36
 */

namespace Saci\Console\Infrastructure\Application;


use Saci\Console\Application\Events\EventManagerAdpter;
use Saci\Console\Domain\Events\Event;
use Saci\Console\Domain\Events\Subscriber;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SymfonyEventAdapter implements EventManagerAdpter
{

    private static $instance;
    /** @var EventDispatcher */
    private $eventDispatcher;

    private function __construct()
    {
        $this->eventDispatcher = new EventDispatcher();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function addSubscriber(Subscriber $subscriber)
    {
        /** @var EventSubscriberInterface $subs */
        $subs = $subscriber;
        $this->eventDispatcher->addSubscriber($subs);
    }

    public function publish(Event $event)
    {
        /** @var \Symfony\Component\EventDispatcher\Event $event */
        $evt = $event;
        $this->eventDispatcher->dispatch($event->getName(), $evt);
    }

    private function __clone()
    {
    }
}