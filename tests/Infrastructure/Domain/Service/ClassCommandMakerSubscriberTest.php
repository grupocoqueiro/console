<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 19/01/2019
 * Time: 11:58
 */

namespace Test\Infrastructure\Domain\Service;

use PHPUnit\Framework\TestCase;
use Saci\Console\Domain\Entity\Command;
use Saci\Console\Domain\Entity\Module;
use Saci\Console\Domain\Events\CommandWasCreated;
use Saci\Console\Infrastructure\Domain\Services\ClassCommandMakerSubscriber;
use Symfony\Component\Filesystem\Filesystem;

class ClassCommandMakerSubscriberTest extends TestCase
{

    /** @var ClassCommandMakerSubscriber */
    private $subscriber;

    /**
     * @test
     */
    public function verifica_se_e_criado_uma_instancia_de_ClassCommandMakerSubscriber()
    {
        $this->assertInstanceOf(ClassCommandMakerSubscriber::class, $this->subscriber);
    }

    public function testGetSubscribedEvents()
    {
        $array = ['command.create.event' => 'create'];
        $this->assertArraySubset($array, $this->subscriber::getSubscribedEvents());
    }

    public function testCreate()
    {
        $commandWasCreated = $this->createMock(CommandWasCreated::class);
        $module = $this->createMock(Module::class);
        $module
            ->method('getName')
            ->willReturn('Test');
        $command = $this->createMock(Command::class);
        $command
            ->method('getModule')
            ->willReturn($module);

        $command
            ->method('getClassNameCommand')
            ->willReturn('TestCommand');

        $command
            ->method('getName')
            ->willReturn('Teste');

        $command
            ->method('getLocalFileCommand')
            ->willReturn('c:/temp/TestCommand.php');

        $commandWasCreated
            ->method('getCommand')
            ->willReturn($command);

        $result = $this->subscriber->create($commandWasCreated);

        $this->assertTrue($result);

        (new Filesystem())->remove('c:/temp/TestCommand.php');
    }

    protected function setUp()
    {
        $this->subscriber = new ClassCommandMakerSubscriber();
    }
}
