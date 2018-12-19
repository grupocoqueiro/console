<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 11/12/2018
 * Time: 18:32
 */

namespace Saci\Console\Domain\Services;


use Saci\Console\Domain\Events\ModuleWasCreated;
use Saci\Console\Domain\Events\Subscriber;

interface ClassServiceProviderMakerSubscriber extends Subscriber
{
    public function create(ModuleWasCreated $created);
}