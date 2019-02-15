<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 22/01/2019
 * Time: 10:41
 */

namespace Test\Application\Commands;

use PHPUnit\Framework\TestCase;
use Saci\Console\Application\Commands\CommandHandlerMakerCommand;
use Saci\Console\Infrastructure\Application\SymfonyEventAdapter;
use Saci\Console\Infrastructure\Domain\Services\ClassCommandHandlerMakerSubscriber;
use Saci\Console\Infrastructure\Domain\Services\ClassCommandMakerSubscriber;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Filesystem\Filesystem;

class CommandHandlerMakerCommandTest extends TestCase
{
    /** @var CommandHandlerMakerCommand */
    private $command;

    public function setUp()
    {
        $this->command = new CommandHandlerMakerCommand();
    }

    /**
     * @test
     */
    public function verifica_se_a_configuracao_para_o_comando_de_criacao_d0_modulo_esta_correta()
    {
        $arg1 = $this->command->getDefinition()->getArgument('nome');
        $arg2 = $this->command->getDefinition()->getArgument('diretorio');
        $arg3 = $this->command->getDefinition()->getArgument('nomeModule');

        $this->assertEquals('create:command', $this->command->getName());
        $this->assertEquals('Cria as classe de Command e CommandHandler', $this->command->getDescription());
        $this->assertEquals(3, $this->command->getDefinition()->getArgumentCount());
        $this->assertInstanceOf(InputArgument::class, $arg1);
        $this->assertInstanceOf(InputArgument::class, $arg2);
        $this->assertInstanceOf(InputArgument::class, $arg3);
    }

    /**
     * @test
     */
    public function verifics_se_ao_executar_um_diretorio_do_modulo_e_criado()
    {
        require_once __DIR__ . '/../../../vendor/autoload.php';

        SymfonyEventAdapter::getInstance()->addSubscriber(new ClassCommandMakerSubscriber());
        SymfonyEventAdapter::getInstance()->addSubscriber(new ClassCommandHandlerMakerSubscriber());

        $app = new Application('Saci Console', 'v0.0.1');
        $app->add($this->command);

        $command = $app->find('create:command');

        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName(),
            'nome' => 'Test',
            'diretorio' => 'c:\\temp\\src\\Teste\\UseCases',
            'nomeModule' => 'Teste'
        ]);

        (new Filesystem())->remove('c:' . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Teste');

        $this->assertEquals("Command Handler Test foi criado", str_replace("\n", "", str_replace("\r\n", "", $commandTester->getDisplay())));
    }

}
