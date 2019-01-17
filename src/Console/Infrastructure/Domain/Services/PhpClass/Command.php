<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 17/01/2019
 * Time: 19:47
 */

namespace Saci\Console\Infrastructure\Domain\Services\PhpClass;


use cristianoc72\codegen\model\GenerateableInterface;
use cristianoc72\codegen\model\PhpClass;
use cristianoc72\codegen\model\PhpMethod;
use Saci\Console\Domain\Services\PhpClass as PhpClassInterface;

class Command extends PhpClass implements PhpClassInterface
{

    public function make(string $moduleName): GenerateableInterface
    {
        $this
            ->setQualifiedName("Saci\\{$moduleName}\\UseCase\\")
            ->setInterfaces(['MappingInterface'])
            ->setMethod(
                PhpMethod::create('__construct')
            )
            ->declareUse("Saci\\{$moduleName}\\UseCase\\");

        return $this;
    }
}