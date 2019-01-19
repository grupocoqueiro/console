<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 19/01/2019
 * Time: 14:14
 */

namespace Saci\Console\Infrastructure\Domain\Services\PhpClass;


use Saci\Console\Domain\Services\PhpClass;

abstract class AbstractPhpClass extends \cristianoc72\codegen\model\PhpClass implements PhpClass
{
    private $moduleName;
    private $className;

    public function getModuleName(): string
    {
        return $this->moduleName;
    }

    public function setModuleName(string $moduleName): PhpClass
    {
        $this->moduleName = $moduleName;
        return $this;
    }

    public function getClassName(): ?string
    {
        return $this->className;
    }

    public function setClassName(string $className): PhpClass
    {
        $this->className = $className;
        return $this;
    }
}