<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 24/11/2018
 * Time: 22:07
 */

namespace Saci\Console\Application\Commands;


use Saci\Domain\Entity\Module;
use Saci\Infrastructure\Domain\Service\ModuleMaker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ModuleMakerCommand extends Command
{
    protected function configure()
    {
        $this->setName("create:module")
            ->setDescription("Cria um modulo e suas pastas iniciais")
            ->addArgument("modulo", InputArgument::REQUIRED, "Nome do modulo");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $modulo = $input->getArgument("modulo");

        $module = new Module($modulo);

        (new ModuleMaker())->make($module);

        $output->writeln("Modulo {$module->getName()} foi criado");
    }
}