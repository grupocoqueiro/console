<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 10/12/2018
 * Time: 14:41
 */

namespace Saci\Console\Infrastructure\Domain\Services;


use cristianoc72\codegen\generator\CodeGenerator;

class GeneratorClassFactory
{
    public static function create()
    {
        return new GeneratorClass(new CodeGenerator([
            'generateScalarTypeHints' => true,
            'generateReturnTypeHints' => true
        ]));
    }
}