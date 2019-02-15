<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 22/01/2019
 * Time: 11:16
 */

namespace Saci\Console\Infrastructure\Domain\Services;


use cristianoc72\codegen\model\PhpClass;
use Saci\Console\Domain\Entity\Command;
use Saci\Console\Domain\Events\CommandWasCreated;
use Saci\Console\Domain\Services\ClassCommandHandlerMakerSubscriber;
use Saci\Console\Domain\Services\Exception\MappingNotFoundException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;

class AddingCommandInMappingSubscriber implements ClassCommandHandlerMakerSubscriber, EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [CommandWasCreated::NAME => 'create'];
    }

    /**
     * @param CommandWasCreated $commandWasCreated
     * @return bool
     * @throws MappingNotFoundException
     */
    public function create(CommandWasCreated $commandWasCreated)
    {
        $moduleName = $commandWasCreated->getCommand()->getModule()->getName();
        $commandName = $commandWasCreated->getCommand()->getClassNameCommand();
        $commandHandlerName = $commandWasCreated->getCommand()->getClassNameCommandHandler();

        if (!$commandWasCreated->getCommand()->getModule()->mappingExists()) {
            throw new MappingNotFoundException('O arquivo Mapping não foi encontrado! Crie primeiro o arquivo Mapping.php para depois criar os Commands!');
        }

        $class = PhpClass::fromFile($commandWasCreated->getCommand()->getModule()->getLocalMapping());

        $method = $class->getMethod('__invoke');

        $body = $this->createBody($method->getBody(), $commandWasCreated->getCommand());

        $method->setBody($body);

        $class->declareUses(
            "Saci\\{$moduleName}\\UseCase\\{$commandName}",
            "Saci\\{$moduleName}\\UseCase\\{$commandHandlerName}"
        );

        $generator = GeneratorClassFactory::create();
        $stringClass = $generator->generate($class);

        $stringClass = "<?php\n" . $stringClass;

        (new Filesystem())->dumpFile($commandWasCreated->getCommand()->getModule()->getLocalMapping(), $stringClass);

        return true;
    }

    private function createBody(string $body, Command $command): string
    {
        $bodyNormalized = $this->normalizeBody($body);
        $bodyArray = $this->bodyToArray($bodyNormalized);

        $string = '';
        foreach ($bodyArray as $key => $value) {
            if ($key > 0 && !$value) {
                $string .= "\n\t";
            }

            $string .= $value ? "$value," : "";
        }

        return $body = <<<BODY
return [
     {$string}
     {$command->getClassNameCommand()}::class => {$command->getClassNameCommandHandler()}::class,
];
BODY;

    }

    private function normalizeBody(string $body): string
    {
        return str_replace(['return [', '];'], ['', ''], $body);
    }

    private function bodyToArray(string $body): array
    {
        return explode(',', $body);
    }
}