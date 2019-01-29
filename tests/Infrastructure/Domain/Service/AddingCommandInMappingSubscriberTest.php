<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 22/01/2019
 * Time: 11:18
 */

namespace Test\Infrastructure\Domain\Service;

use PHPUnit\Framework\TestCase;
use Saci\Console\Domain\Entity\Command;
use Saci\Console\Domain\Entity\Module;
use Saci\Console\Domain\Events\CommandWasCreated;
use Saci\Console\Infrastructure\Domain\Services\AddingCommandInMappingSubscriber;
use Saci\Console\Infrastructure\Domain\Services\ClassMaker;
use Saci\Console\Infrastructure\Domain\Services\GeneratorClassFactory;
use Saci\Console\Infrastructure\Domain\Services\PhpClass\Mapping;
use Symfony\Component\Filesystem\Filesystem;

class AddingCommandInMappingSubscriberTest extends TestCase
{
    /**
     * @var AddingCommandInMappingSubscriber
     */
    private $subscriber;

    public function testGetSubscribedEvents()
    {
        $array = ['command.create.event' => 'create'];
        $this->assertArraySubset($array, $this->subscriber::getSubscribedEvents());
    }

    /**
     * @throws \Saci\Console\Domain\Services\Exception\MappingNotFoundException
     */
    public function testCreate()
    {
        $commandWasCreated = $this->createMock(CommandWasCreated::class);
        $module = $this->createMock(Module::class);
        $module
            ->method('getName')
            ->willReturn('Compras');

        $module
            ->method('getDiretorio')
            ->willReturn('c:\\temp');

        $module
            ->method('mappingExists')
            ->willReturn(true);

        $module
            ->method('getLocalMapping')
            ->willReturn('c:\\temp\src\\Compras\\Mapping.php');

        $module
            ->method('getPathModule')
            ->willReturn('c:\\temp\src\\Compras\\');

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

        $commandWasCreated
            ->method('getCommand')
            ->willReturn($command);

        $result = $this->subscriber->create($commandWasCreated);

        $this->assertTrue($result);

        $this->mappingClear($module);

    }

    protected function setUp()
    {
        $this->subscriber = new AddingCommandInMappingSubscriber();
    }

    private function mappingClear(Module $module)
    {
        $classMaker = new ClassMaker($module);
        $generateable = $classMaker->generate(new Mapping());
        $stringClass = GeneratorClassFactory::create()->generate($generateable);

        $stringClass = "<?php\n" . $stringClass;

        (new Filesystem())->dumpFile($module->getPathModule() . DIRECTORY_SEPARATOR . 'Mapping.php', $stringClass);

    }
}
