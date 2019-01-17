<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 17/01/2019
 * Time: 20:05
 */

namespace Saci\Console\Domain\Services;


use Saci\Console\Domain\Events\CommandWasCreated;

interface CommandMakerSubscriber
{
    public function create(CommandWasCreated $commandWasCreated);
}