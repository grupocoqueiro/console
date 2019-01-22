<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 22/01/2019
 * Time: 10:17
 */

namespace Test\Infrastructure\Domain\Service;

use PHPUnit\Framework\TestCase;
use Saci\Console\Domain\Entity\Command;
use Saci\Console\Domain\Entity\Module;
use Saci\Console\Domain\Events\CommandWasCreated;
use Saci\Console\Infrastructure\Domain\Services\ClassCommandHandlerMakerSubscriber;

class ClassCommandHandlerMakerSubscriberTest extends TestCase
{
    /**
     * @var ClassCommandHandlerMakerSubscriber
     */
    private $subscriber;

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
            ->method('getClassNameCommandHandler')
            ->willReturn('TestCommandHandler');

        $command
            ->method('getClassNameCommand')
            ->willReturn('TestCommand');

        $command
            ->method('getName')
            ->willReturn('Teste');

        $command
            ->method('getLocalFileCommandHandler')
            ->willReturn('c:/temp/TestCommandHandler.php');

        $command
            ->method('getLocalFileCommand')
            ->willReturn('c:/temp/TestCommand.php');

        $commandWasCreated
            ->method('getCommand')
            ->willReturn($command);

        $result = $this->subscriber->create($commandWasCreated);

        $this->assertTrue($result);
    }

    protected function setUp()
    {
        $this->subscriber = new ClassCommandHandlerMakerSubscriber();
    }
}
