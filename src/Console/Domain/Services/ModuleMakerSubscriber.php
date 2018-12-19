<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 11/12/2018
 * Time: 12:43
 */

namespace Saci\Console\Domain\Services;


use Saci\Console\Domain\Events\ModuleWasCreated;
use Saci\Console\Domain\Events\Subscriber;

interface ModuleMakerSubscriber extends Subscriber
{
    public function createModule(ModuleWasCreated $created);
}