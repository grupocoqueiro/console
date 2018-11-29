<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 24/11/2018
 * Time: 23:00
 */

namespace Test\Domain\Entity;


use PHPUnit\Framework\TestCase;
use Saci\Domain\Entity\Module;

/**
 * Class ModuleTest
 * @package Test\Domain\Entity
 * @covers \Saci\Domain\Entity\Module
 */
class ModuleTest extends TestCase
{

    const PROJECT_NAME = 'Teste';

    const DS = DIRECTORY_SEPARATOR;
    const ROOT = 'c:' . self::DS . 'temp' . self::DS .'src';
    const APPLICATION = self::DS . 'Application';
    const USE_CASE = self::APPLICATION . self::DS . 'UseCase';
    const CONTROLLERS = self::USE_CASE . self::DS . 'Controllers';
    const COMMANDS = self::USE_CASE . self::DS . 'Commands';
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

    private $paths = [
        self::ROOT . self::DS . self::PROJECT_NAME . self::DS . self::CONTROLLERS,
        self::ROOT . self::DS . self::PROJECT_NAME . self::DS . self::COMMANDS,
        self::ROOT . self::DS . self::PROJECT_NAME . self::DS . self::ENTITIES,
        self::ROOT . self::DS . self::PROJECT_NAME . self::DS . self::VO,
        self::ROOT . self::DS . self::PROJECT_NAME . self::DS . self::EVENTS,
        self::ROOT . self::DS . self::PROJECT_NAME . self::DS . self::REPOSITORIES,
        self::ROOT . self::DS . self::PROJECT_NAME . self::DS . self::MAPPING,
        self::ROOT . self::DS . self::PROJECT_NAME . self::DS . self::INFRASTRUCTURE_REPOSITORIES,
    ];

    /** @var Module */
    private $module;

    public function setUp()
    {
        $this->module = new Module(self::PROJECT_NAME, 'c:' . self::DS . 'temp');
    }

    /**
     * @test
     */
    public function verifica_se_a_entidade_module_pode_ser_criada()
    {

        $this->assertInstanceOf(Module::class, $this->module);
    }

    /**
     * @test
     */
    public function verifica_o_nome_retornado()
    {
        $this->assertEquals('Teste', $this->module->getName());
    }

    /**
     * @test
     */
    public function verifica_o_diretorio_pode_ser_retornado()
    {
        $this->assertEquals('c:' . self::DS . 'temp', $this->module->getDiretorio());
    }

    /**
     * @test
     */
    public function verifica_o_path_do_modulo_pode_ser_retornado()
    {
        $this->assertEquals( self::ROOT . self::DS . self::PROJECT_NAME, $this->module->getPathModule());
    }

    /**
     * @test
     */
    public function verifica_se_path_e_um_array_com_os_diretorios_corretos()
    {
        $this->assertEquals($this->paths, $this->module->getPaths());
    }
}