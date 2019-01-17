<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 14/01/2019
 * Time: 19:10
 */

namespace Saci\Console\Application\Commands;


use Saci\Console\Domain\Entity\Module;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CommandHandlerMakerCommand extends Command
{
    protected function configure()
    {
        $this->setName("create:module")
            ->setDescription("Cria as classe de Command e CommandHandler")
            ->addArgument("nome", InputArgument::REQUIRED, "Nome do Command Handler")
            ->addArgument("diretorio", InputArgument::REQUIRED, "Local onde será criado o Command handler")
            ->addArgument("nomeModule", InputArgument::REQUIRED, "Nome do módulo");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $nome = $input->getArgument("nome");
        $diretorio = $input->getArgument("diretorio");
        $moduleName = $input->getArgument("nomeModule");

        $module = new Module($moduleName, $diretorio);
        \Saci\Console\Domain\Entity\Command::create($nome, $module);

        $output->writeln("Command Handler {$nome} foi criado");
    }
}