<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 14/01/2019
 * Time: 19:49
 */

namespace Saci\Console\Infrastructure\Domain\Events;


use Saci\Console\Domain\Entity\Command;
use Symfony\Component\EventDispatcher\Event;

class CommandWasCreated extends Event implements \Saci\Console\Domain\Events\CommandWasCreated
{

    /**
     * @var Command
     */
    private $command;

    public function __construct(Command $command)
    {

        $this->command = $command;
    }

    /**
     * @return Command
     */
    public function getCommand(): Command
    {
       return $this->command;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}