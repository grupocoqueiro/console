<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 14/01/2019
 * Time: 19:18
 */

namespace Test\Domain\Entity;


use PHPUnit\Framework\TestCase;
use Saci\Console\Domain\Entity\Command;
use Saci\Console\Domain\Entity\Module;

class CommandTest extends TestCase
{

    /** @var Command */
    private $command;

    public function setUp()
    {
        $module = $this->createMock(Module::class);
        $module->method('getDiretorio')->willReturn('c:' . DIRECTORY_SEPARATOR . 'temp');
        $module->method('getName')->willReturn('Test');
        $this->command = new Command('Test', $module);
    }

    /**
     * @test
     */
    public function verifica_se_e_possivel_criar_instancia()
    {
        $this->assertInstanceOf(Command::class, $this->command);
    }

    /**
     * @test
     */
    public function verifica_se_e_possivel_pegar_nome_do_command()
    {
        $this->assertEquals('Test', $this->command->getName());
    }

    /**
     * @test
     */
    public function verifica_se_e_possivel_pegar_nome_do_diretorio_command()
    {
        $this->assertEquals('c:\temp', $this->command->getDiretorio());
    }

    /**
     * @test
     */
    public function verifica_se_e_possivel_pegar_nome_da_classe_do_command()
    {
        $this->assertEquals('TestCommand', $this->command->getClassNameCommand());
    }

    /**
     * @test
     */
    public function verifica_se_e_possivel_pegar_nome_da_classe_do_command_handler()
    {
        $this->assertEquals('TestCommandHandler', $this->command->getClassNameCommandHandler());
    }

    /**
     * @test
     */
    public function verifica_se_e_possivel_pegar_uma_instancia_de_module()
    {
        $this->assertInstanceOf(Module::class, $this->command->getModule());
    }

    /**
     * @test
     */
    public function verifica_se_e_possivel_retornar_o_nome_do_local_do_arquivo_da_command()
    {
        $expected = 'c:' . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . 'TestCommand.php';
        $this->assertEquals($expected, $this->command->getLocalFileCommand());
    }

    /**
     * @test
     */
    public function verifica_se_e_possivel_retornar_o_nome_do_local_do_arquivo_da_command_handler()
    {
        $expected = 'c:' . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . 'TestCommandHandler.php';
        $this->assertEquals($expected, $this->command->getLocalFileCommandHandler());
    }


}