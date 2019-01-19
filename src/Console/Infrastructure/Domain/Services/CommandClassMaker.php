<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 19/01/2019
 * Time: 14:04
 */

namespace Saci\Console\Infrastructure\Domain\Services;


use cristianoc72\codegen\model\GenerateableInterface;
use Saci\Console\Domain\Entity\Command;
use Saci\Console\Domain\Services\PhpClass;

class CommandClassMaker implements \Saci\Console\Domain\Services\ClassMaker
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
            ->setClassName($this->command->getClassNameCommand())
            ->make();
    }
}