<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 04/12/2018
 * Time: 18:55
 */

namespace Test\Infrastructure\Domain\Service;

use PHPUnit\Framework\TestCase;
use Saci\Console\Domain\Services\GeneratorClass;
use Saci\Console\Infrastructure\Domain\Services\GeneratorClassFactory;

class GeneratorClassFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function verifica_se_e_possivel_criar_ima_intancia_de_GeneratorClass()
    {
        $this->assertInstanceOf(GeneratorClass::class, GeneratorClassFactory::create());
    }
}
