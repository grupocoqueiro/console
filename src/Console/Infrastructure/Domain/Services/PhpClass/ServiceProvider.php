<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 03/12/2018
 * Time: 18:17
 */

namespace Saci\Console\Infrastructure\Domain\Services\PhpClass;


use cristianoc72\codegen\model\GenerateableInterface;
use cristianoc72\codegen\model\PhpConstant;
use cristianoc72\codegen\model\PhpMethod;
use cristianoc72\codegen\model\PhpProperty;
use Saci\Console\Domain\Services\PhpClass as PhpClassInterface;

class ServiceProvider extends AbstractPhpClass implements PhpClassInterface
{

    public function make(): GenerateableInterface
    {
        $moduleName = $this->getModuleName();
        $className = $this->getClassName() ?: $moduleName . 'ServiceProvider';

        $this
            ->setQualifiedName("Saci\\{$moduleName}\\{$className}")
            ->declareUses(
                'App\\Model\\Core\\Container\\ServiceProvider\\ServiceProvider'
            )
            ->setParentClassName('ServiceProvider')
            ->setMethod(
                PhpMethod::create('register')
            )
            ->setProperty(
                PhpProperty::create('provides')
                ->setVisibility('protected')
                ->setType('array')
                ->setValue(PhpConstant::create('[]', [], true))
            );


        return $this;
    }
}