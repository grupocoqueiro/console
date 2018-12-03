<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 03/12/2018
 * Time: 16:52
 */

namespace Saci\Console\Infrastructure\Domain\Services;


use cristianoc72\codegen\generator\CodeGenerator;
use Saci\Console\Domain\Entity\Module;
use Saci\Console\Domain\Services\PhpClass;
use Saci\Console\Domain\Services\ClassMaker as ClassMakerIterface;

class ClassMaker implements ClassMakerIterface
{
    /**
     * @var CodeGenerator
     */
    private $codeGenerator;
    /**
     * @var Module
     */
    private $module;

    /**
     * ClassMappingMaker constructor.
     * @param Module $module
     * @param CodeGenerator $codeGenerator
     */
    public function __construct(Module $module, CodeGenerator $codeGenerator)
    {
        $this->codeGenerator = $codeGenerator;
        $this->module = $module;
    }

    /**
     * @param PhpClass $phpClass
     * @return string
     */
    public function generate(PhpClass $phpClass)
    {
        $code = $phpClass->make($this->module->getName());

        return $this->codeGenerator->generate($code);
    }
}