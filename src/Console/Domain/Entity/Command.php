<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 14/01/2019
 * Time: 19:15
 */

namespace Saci\Console\Domain\Entity;


use Saci\Console\Infrastructure\Application\SymfonyEventAdapter;
use Saci\Console\Infrastructure\Domain\Events\CommandWasCreated;

class Command
{
    /** @var string */
    private $name;
    /**
     * @var Module
     */
    private $module;

    public function __construct(string $name, Module $module)
    {
        $this->name = $name;
        $this->module = $module;
    }

    /**
     * @param string $name
     * @param Module $module
     * @return Command
     */
    public static function create(string $name, Module $module): Command
    {
        $command = new self($name, $module);
        SymfonyEventAdapter::getInstance()->publish(
            new CommandWasCreated($command)
        );
        return $command;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDiretorio(): string
    {
        return $this->module->getDiretorio();
    }

    public function getClassNameCommand()
    {
        return ucfirst(strtolower($this->getName())) . 'Command';
    }

    public function getLocalFileCommand(): string
    {
        return $this->getDiretorio()
            . DIRECTORY_SEPARATOR
            . $this->getClassNameCommand()
            . '.php';
    }

    public function getClassNameCommandHandler()
    {
        return ucfirst(strtolower($this->getName())) . 'CommandHandler';
    }

    public function getModule(): Module
    {
        return $this->module;
    }

    public function getLocalFileCommandHandler()
    {
        return $this->getDiretorio()
            . DIRECTORY_SEPARATOR
            . $this->getClassNameCommandHandler()
            . '.php';
    }
}