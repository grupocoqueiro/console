<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 03/12/2018
 * Time: 17:54
 */

namespace Saci\Console\Domain\Services;


use cristianoc72\codegen\model\GenerateableInterface;

interface PhpClass
{
    public function setModuleName(string $moduleName): PhpClass;

    public function setClassName(string $className): PhpClass;

    public function getModuleName(): string;

    public function getClassName(): ?string;

    public function make(): GenerateableInterface;
}