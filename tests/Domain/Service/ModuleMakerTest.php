<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 28/11/2018
 * Time: 15:41
 */

namespace Test\Domain\Service;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Saci\Console\Domain\Entity\Module;
use Saci\Console\Domain\Exceptions\ModuleAlreadyExists;
use Saci\Console\Infrastructure\Domain\Services\ModuleMaker;

class ModuleMakerTest extends TestCase
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

    /** @var MockObject */
    private $mockModule;

    public function setUp()
    {

        $this->mockModule = $this
            ->getMockBuilder(Module::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @test
     * @throws \Saci\Console\Domain\Exceptions\ModuleAlreadyExists
     */
    public function verifica_se_e_possivel_criar_um_modulo()
    {

        $this->mockModule
            ->method('getPathModule')
            ->willReturn(self::ROOT . DIRECTORY_SEPARATOR . self::PROJECT_NAME);

        $this->mockModule
            ->method('getPaths')
            ->willReturn($this->paths);

        $this->mockModule
            ->method('getPathModule')
            ->willReturn(self::ROOT . self::DS . self::PROJECT_NAME);
        /** @var \Saci\Console\Domain\Entity\Module $module */
        $module = $this->mockModule;

        (new ModuleMaker())->make($module);

        foreach ($this->paths as $path) {
            $this->assertFileExists($path);
            rmdir($path);
        }

        (new ModuleMaker())->remove($module->getPathModule());
    }

    /**
     * @test
     * @throws \Saci\Console\Domain\Exceptions\ModuleAlreadyExists
     */
    public function lanca_excecao_caso_o_modulo_ja_exista()
    {
        $this->expectException(ModuleAlreadyExists::class);
        $this->expectExceptionMessage('Modulo "' . self::PROJECT_NAME . '" já existe');
        $this->mockModule
            ->method('getPathModule')
            ->willReturn('c:' . self::DS . 'inetpub' . self::DS . 'apps' . self::DS . 'console' . self::DS . 'tests' . self::DS .'Storage' . DIRECTORY_SEPARATOR . self::PROJECT_NAME);

        $this->mockModule
            ->method('getName')
            ->willReturn(self::PROJECT_NAME);
        /** @var Module $module */
        $module = $this->mockModule;

        (new ModuleMaker())->make($module);

    }
}
