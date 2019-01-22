<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 17/01/2019
 * Time: 20:12
 */

namespace Saci\Console\Infrastructure\Domain\Services\PhpClass;


use cristianoc72\codegen\model\GenerateableInterface;
use cristianoc72\codegen\model\PhpMethod;
use cristianoc72\codegen\model\PhpParameter;
use Saci\Console\Domain\Services\Exception\ClassNameIsNullException;
use Saci\Console\Domain\Services\PhpClass as PhpClassInterface;

class CommandHandler extends AbstractPhpClass implements PhpClassInterface
{

    public function make(): GenerateableInterface
    {
        $moduleName = $this->getModuleName();
        $className = $this->getClassName();
        $type = str_replace('Handler', '', $className);
        $parameter = lcfirst($type);

        if (!$className) {
            throw new ClassNameIsNullException('Não foi informado a nome para a Command. Utilize o método setClassName para innforma o nome da classe!');
        }

        $this
            ->setQualifiedName("Saci\\{$moduleName}\\UseCase\\{$className}")
            ->setMethod(
                PhpMethod::create('__construct')
            )
            ->setMethod(
                PhpMethod::create('handle')
                    ->addParameter(
                        PhpParameter::create($parameter)
                            ->setType($type)
                    )
            );

        return $this;
    }
}