<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 11/12/2018
 * Time: 12:28
 */

namespace Saci\Console\Infrastructure\Domain\Events;


use Saci\Console\Domain\Entity\Module;
use Symfony\Component\EventDispatcher\Event;

class ModuleWasCreated extends Event implements \Saci\Console\Domain\Events\ModuleWasCreated
{
    /**
     * @var Module
     */
    private $module;

    public function __construct(Module $module)
    {
        $this->module = $module;
    }

    /**
     * @return Module
     */
    public function getModule(): Module
    {
        return $this->module;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}