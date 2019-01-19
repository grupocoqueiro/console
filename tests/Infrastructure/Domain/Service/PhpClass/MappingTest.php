<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 03/12/2018
 * Time: 18:18
 */

namespace Test\Infrastructure\Domain\Service\PhpClass;

use cristianoc72\codegen\model\GenerateableInterface;
use PHPUnit\Framework\TestCase;
use Saci\Console\Infrastructure\Domain\Services\PhpClass\Mapping;

class MappingTest extends TestCase
{
    /**
     * @test
     */
    public function verifica_se_sera_retornado_uma_instancia_de_GenerateableInterface()
    {
        $mapping = (new Mapping())
            ->setModuleName('Test');
        $this->assertInstanceOf(GenerateableInterface::class, $mapping->make());
    }
}
