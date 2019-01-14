<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 14/01/2019
 * Time: 19:15
 */

namespace Saci\Console\Domain\Entity;


class Command
{
    /** @var string */
    private $name;
    /** @var string */
    private $diretorio;

    public function __construct(string $name, string $diretorio)
    {
        $this->name = $name;
        $this->diretorio = $diretorio;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDiretorio(): string
    {
        return $this->diretorio;
    }

    public function getClassNameCommand()
    {
        return ucfirst(strtolower($this->getName())) . 'Command';
    }

    public function getClassNameCommandHandler()
    {
        return ucfirst(strtolower($this->getName())) . 'CommandHandler';
    }
}