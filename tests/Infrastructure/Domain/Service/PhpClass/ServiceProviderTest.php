<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 03/12/2018
 * Time: 18:20
 */

namespace Test\Infrastructure\Domain\Service\PhpClass;

use cristianoc72\codegen\model\GenerateableInterface;
use PHPUnit\Framework\TestCase;
use Saci\Console\Infrastructure\Domain\Services\PhpClass\ServiceProvider;

class ServiceProviderTest extends TestCase
{

    /**
     * @test
     */
    public function verifica_se_sera_retornado_uma_instancia_de_GenerateableInterface()
    {
        $serviceProvider = (new ServiceProvider())
            ->setModuleName('Test');
        $this->assertInstanceOf(GenerateableInterface::class, $serviceProvider->make());
    }
}
