<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 17/01/2019
 * Time: 20:05
 */

namespace Saci\Console\Domain\Services;


use Saci\Console\Domain\Events\CommandWasCreated;
use Saci\Console\Domain\Events\Subscriber;

interface ClassCommandMakerSubscriber extends Subscriber
{
    public function create(CommandWasCreated $commandWasCreated);
}