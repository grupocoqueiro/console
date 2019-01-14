<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 14/01/2019
 * Time: 19:43
 */

namespace Saci\Console\Domain\Events;


use Saci\Console\Domain\Entity\Command;

interface CommandWasCreated extends Event
{
    const NAME = 'command.create.event';

    public function __construct(Command $command);

    /**
     * @return Command
     */
    public function getCommand(): Command;
}