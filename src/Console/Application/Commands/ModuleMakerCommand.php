<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 24/11/2018
 * Time: 22:07
 */

namespace Saci\Console\Application\Commands;


use Saci\Console\Domain\Entity\Module;
use Saci\Console\Infrastructure\Domain\Services\ModuleMaker;
use Saci\Console\Infrastructure\Domain\Services\ModuleMakerFactory;
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
            ->addArgument("modulo", InputArgument::REQUIRED, "Nome do modulo")
            ->addArgument("diretorio", InputArgument::REQUIRED, "Local onde será criado o modulo");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Saci\Console\Domain\Exceptions\ModuleAlreadyExists
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $modulo = $input->getArgument("modulo");
        $diretorio = $input->getArgument("diretorio");

        $module = new Module($modulo, $diretorio);

        $moduleMaker = ModuleMakerFactory::create();

        $moduleMaker->make($module);

        $output->writeln("Modulo {$module->getName()} foi criado");
    }
}