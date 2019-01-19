<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 17/01/2019
 * Time: 19:47
 */

namespace Saci\Console\Infrastructure\Domain\Services\PhpClass;


use cristianoc72\codegen\model\GenerateableInterface;
use cristianoc72\codegen\model\PhpMethod;
use Saci\Console\Domain\Services\PhpClass as PhpClassInterface;

class Command extends AbstractPhpClass implements PhpClassInterface
{

    public function make(): GenerateableInterface
    {
        $moduleName = $this->getModuleName();
        $className = $this->getClassName() ?: 'Mapping';

        $this
            ->setQualifiedName("Saci\\{$moduleName}\\UseCase\\{$className}")
            ->setMethod(
                PhpMethod::create('__construct')
            );

        return $this;
    }
}