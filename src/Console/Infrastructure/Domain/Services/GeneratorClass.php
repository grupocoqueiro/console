<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 10/12/2018
 * Time: 14:34
 */

namespace Saci\Console\Infrastructure\Domain\Services;


use cristianoc72\codegen\generator\CodeGenerator;
use cristianoc72\codegen\model\GenerateableInterface;

class GeneratorClass implements \Saci\Console\Domain\Services\GeneratorClass
{

    /**
     * @var CodeGenerator
     */
    private $generator;

    public function __construct(CodeGenerator $generator)
    {
        $this->generator = $generator;
    }

    public function generate(GenerateableInterface $generateable): string
    {
        return $this->generator->generate($generateable);
    }
}