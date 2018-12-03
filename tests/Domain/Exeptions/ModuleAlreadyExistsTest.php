<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 28/11/2018
 * Time: 15:36
 */

namespace Test\Domain\Exeptions;

use PHPUnit\Framework\TestCase;
use Saci\Console\Domain\Exceptions\ModuleAlreadyExists;

class ModuleAlreadyExistsTest extends TestCase
{

    /**
     * @test
     */
    public function verifica_se_a_classe_ModuleAlreadyExistsTest_pode_ser_criada()
    {
        $this->assertInstanceOf(ModuleAlreadyExists::class, new ModuleAlreadyExists());
    }

    /**
     * @test
     */
    public function verifica_se_a_mensagem_pode_ser_obitida()
    {
        $this->assertEquals('Modulo "teste" já existe', (new ModuleAlreadyExists('teste'))->getMessage());
    }
}
