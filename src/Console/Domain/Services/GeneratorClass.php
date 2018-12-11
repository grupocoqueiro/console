<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 10/12/2018
 * Time: 14:24
 */

namespace Saci\Console\Domain\Services;


use cristianoc72\codegen\generator\CodeGenerator;
use cristianoc72\codegen\model\GenerateableInterface;

interface GeneratorClass
{
    public function __construct(CodeGenerator $generator);

    public function create(GenerateableInterface $generateable): string;
}