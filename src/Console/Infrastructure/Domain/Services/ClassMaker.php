<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 03/12/2018
 * Time: 16:52
 */

namespace Saci\Console\Infrastructure\Domain\Services;


use cristianoc72\codegen\model\GenerateableInterface;
use Saci\Console\Domain\Entity\Module;
use Saci\Console\Domain\Services\ClassMaker as ClassMakerIterface;
use Saci\Console\Domain\Services\PhpClass;

class ClassMaker implements ClassMakerIterface
{
    /**
     * @var Module
     */
    private $module;

    /**
     * ClassMappingMaker constructor.
     * @param Module $module
     */
    public function __construct(Module $module)
    {
        $this->module = $module;
    }

    /**
     * @param PhpClass $phpClass
     * @return GenerateableInterface
     */
    public function generate(PhpClass $phpClass): GenerateableInterface
    {
        return $phpClass->make($this->module->getName());
    }
}