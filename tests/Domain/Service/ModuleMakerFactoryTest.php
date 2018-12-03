<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 03/12/2018
 * Time: 15:30
 */

namespace Test\Domain\Service;

use PHPUnit\Framework\TestCase;
use Saci\Console\Domain\Services\ModuleMaker;
use Saci\Console\Infrastructure\Domain\Services\ModuleMakerFactory;

class ModuleMakerFactoryTest extends TestCase
{

    /**
     * @test
     */
    public function verifica_se_e_possivel_criar_uma_instancia_de_MoludeMaker()
    {
        $this->assertInstanceOf(ModuleMaker::class, ModuleMakerFactory::create());
    }
}
