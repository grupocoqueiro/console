<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 14/01/2019
 * Time: 19:10
 */

namespace Saci\Console\Application\Commands;


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
            ->addArgument("command", InputArgument::REQUIRED, "Nome do Command Handler")
            ->addArgument("diretorio", InputArgument::REQUIRED, "Local onde será criado o Command handler");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $commandHandler = $input->getArgument("command");
        //$diretorio = $input->getArgument("diretorio");



        $output->writeln("Command Handler {$commandHandler} foi criado");
    }
}