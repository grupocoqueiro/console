<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 03/12/2018
 * Time: 16:57
 */

namespace Saci\Console\Domain\Services;


use cristianoc72\codegen\model\GenerateableInterface;

interface ClassMaker
{
    public function generate(PhpClass $phpClass): GenerateableInterface;
}