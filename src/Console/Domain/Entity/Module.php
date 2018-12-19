<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 24/11/2018
 * Time: 22:35
 */

namespace Saci\Console\Domain\Entity;

use Saci\Console\Infrastructure\Application\SymfonyEventAdapter;

/**
 * Class Module
 * @package Saci\Domain\Entity
 * @covers \Test\Domain\Entity\ModuleTest
 */
class Module
{

    const DS = DIRECTORY_SEPARATOR;
    const ROOT = 'src';
    const APPLICATION = self::DS . 'Application';
    const USE_CASE = self::DS . 'UseCase,';
    const CONTROLLERS = self::APPLICATION . self::DS . 'Controllers';
    const DOMAIN = self::DS . 'Domain';
    const ENTITIES = self::DOMAIN . self::DS . 'Entities';
    const VO = self::DOMAIN . self::DS . 'ValueObjects';
    const EVENTS = self::DOMAIN . self::DS . 'Events';
    const REPOSITORIES = self::DOMAIN . self::DS . 'Repositories';
    const INFRASTRUCTURE =  self::DS . 'Infrastructure';
    const PERSISTENCE = self::INFRASTRUCTURE . self::DS . 'Persistence';
    const ORM = self::PERSISTENCE . self::DS . 'ORM';
    const DOCTRINE = self::ORM . self::DS . 'Doctrine';
    const MAPPING = self::DOCTRINE . self::DS . 'Mapping';
    const INFRASTRUCTURE_REPOSITORIES = self::DOCTRINE . self::DS . 'Repositories';

    private $name;

    private $paths = [
        self::CONTROLLERS,
        self::USE_CASE,
        self::ENTITIES,
        self::VO,
        self::EVENTS,
        self::REPOSITORIES,
        self::MAPPING,
        self::INFRASTRUCTURE_REPOSITORIES,
    ];
    /**
     * @var string
     */
    private $diretorio;

    public function __construct(string $name, string $diretorio)
    {
        $this->name = ucfirst(strtolower($name));
        $this->diretorio = $diretorio;

        foreach ($this->paths as &$path) {
            $path = $this->getDiretorio() . self::DS . self::ROOT . self::DS . $this->getName() . DIRECTORY_SEPARATOR . $path;
        }
    }

    /**
     * @param string $name
     * @param string $diretorio
     * @return Module
     */
    public static function create(string $name, string $diretorio): Module
    {
        $module = new self($name, $diretorio);
        SymfonyEventAdapter::getInstance()->publish(
            new \Saci\Console\Infrastructure\Domain\Events\ModuleWasCreated($module)
        );

        return $module;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    public function getPaths(): array
    {
        return $this->paths;
    }

    public function getPathModule()
    {
        return $this->getDiretorio() . self::DS . self::ROOT . self::DS . $this->getName();
    }

    /**
     * @return string
     */
    public function getDiretorio(): string
    {
        return $this->diretorio;
    }
}