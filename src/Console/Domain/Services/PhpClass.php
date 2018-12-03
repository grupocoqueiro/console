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
    public function make(string $moduleName): GenerateableInterface;
}