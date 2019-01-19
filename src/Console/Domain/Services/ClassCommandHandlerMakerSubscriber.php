<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 17/01/2019
 * Time: 20:06
 */

namespace Saci\Console\Domain\Services;


use Saci\Console\Domain\Events\CommandWasCreated;
use Saci\Console\Domain\Events\Subscriber;

interface ClassCommandHandlerMakerSubscriber extends Subscriber
{
    public function create(CommandWasCreated $commandWasCreated);
}