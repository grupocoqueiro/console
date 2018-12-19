<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 11/12/2018
 * Time: 13:27
 */

namespace Saci\Console\Application\Events;


use Saci\Console\Domain\Events\Event;
use Saci\Console\Domain\Events\Subscriber;

interface EventManagerAdpter
{

    public function addSubscriber(Subscriber $subscriber);

    public function publish(Event $event);
}