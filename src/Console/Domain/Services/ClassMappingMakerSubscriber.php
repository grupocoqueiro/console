<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 11/12/2018
 * Time: 15:35
 */

namespace Saci\Console\Domain\Services;


use Saci\Console\Domain\Events\ModuleWasCreated;
use Saci\Console\Domain\Events\Subscriber;

interface ClassMappingMakerSubscriber extends Subscriber
{
    public function create(ModuleWasCreated $created);
}