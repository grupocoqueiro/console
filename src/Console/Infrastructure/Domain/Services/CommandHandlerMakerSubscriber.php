<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 17/01/2019
 * Time: 20:18
 */

namespace Saci\Console\Infrastructure\Domain\Services;


use Saci\Console\Domain\Events\CommandWasCreated;
use Saci\Console\Domain\Services\CommandoHandlerMakerSubscriber;

class CommandHandlerMakerSubscriber implements CommandoHandlerMakerSubscriber
{

    public function create(CommandWasCreated $commandWasCreated)
    {
        // TODO: Implement create() method.
    }
}