<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 28/11/2018
 * Time: 15:34
 */

namespace Test\Application\Commands;


use PHPUnit\Framework\TestCase;
use Saci\Console\Application\Commands\ModuleMakerCommand;
use Saci\Infrastructure\Domain\Service\ModuleMaker;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Tester\CommandTester;

class ModuleMakerCommandTest extends TestCase
{
    /** @var ModuleMakerCommand */
    private $command;

    public function setUp()
    {
        $this->command = new ModuleMakerCommand();
    }

    /**
     * @test
     */
    public function verifica_se_a_configuracao_para_o_comando_de_criacao_d0_modulo_esta_correta()
    {
        $arg1 =  $this->command->getDefinition()->getArgument('modulo');
        $arg2 =  $this->command->getDefinition()->getArgument('diretorio');

        $this->assertEquals('create:module', $this->command->getName());
        $this->assertEquals('Cria um modulo e suas pastas iniciais', $this->command->getDescription());
        $this->assertEquals(2, $this->command->getDefinition()->getArgumentCount());
        $this->assertInstanceOf(InputArgument::class, $arg1);
        $this->assertInstanceOf(InputArgument::class, $arg2);
    }

    /**
     * @test
     */
    public function verifi_se_ao_executar_um_diretorio_do_modulo_e_criado()
    {
        require_once __DIR__ . '/../../../vendor/autoload.php';

        $app = new Application('Saci Console', 'v0.0.1');
        $app->add(new ModuleMakerCommand());

        $command = $app->find('create:module');

        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName(),
            'modulo' => 'Teste',
            'diretorio' => 'c:' . DIRECTORY_SEPARATOR . 'temp'
        ]);

        (new ModuleMaker())->remove('c:' . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Teste');

        $this->assertEquals("Modulo Teste foi criado\r\n", $commandTester->getDisplay());
    }

}