<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 03/12/2018
 * Time: 17:55
 */

namespace Saci\Console\Infrastructure\Domain\Services\PhpClass;


use cristianoc72\codegen\model\GenerateableInterface;
use cristianoc72\codegen\model\PhpClass;
use cristianoc72\codegen\model\PhpMethod;
use Saci\Console\Domain\Services\PhpClass as PhpClassInterface;

class Mapping extends PhpClass implements PhpClassInterface
{

    public function make(string $moduleName): GenerateableInterface
    {
        $this
            ->setQualifiedName("Saci\\{$moduleName}\\Mapping")
            ->setInterfaces(['MappingInterface'])
            ->setMethod(
                PhpMethod::create('__invoke')
                    ->setType('array')
                    ->setDescription('Retorna o mapeamento dos commands')
            )
            ->declareUse('GrupoCoqueiro\\CommandBus\\MappingInterface');

        return $this;
    }
}