<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 22/01/2019
 * Time: 10:28
 */

namespace Saci\Console\Infrastructure\Domain\Services;


use cristianoc72\codegen\model\GenerateableInterface;
use Saci\Console\Domain\Entity\Command;
use Saci\Console\Domain\Services\PhpClass;

class CommandHandlerClassMaker implements \Saci\Console\Domain\Services\ClassMaker
{
    /**
     * @var Command
     */
    private $command;

    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    public function generate(PhpClass $phpClass): GenerateableInterface
    {
        return $phpClass
            ->setModuleName($this->command->getModule()->getName())
            ->setClassName($this->command->getClassNameCommandHandler())
            ->make();
    }
}