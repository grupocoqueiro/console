<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 11/12/2018
 * Time: 12:48
 */

namespace Saci\Console\Domain\Events;


use Saci\Console\Domain\Entity\Module;

interface ModuleWasCreated extends Event
{
    const NAME = 'module.create.event';

    public function __construct(Module $module);

    /**
     * @return Module
     */
    public function getModule(): Module;
}