<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 03/12/2018
 * Time: 16:42
 */

namespace Test\Infrastructure\Domain\Service;

use cristianoc72\codegen\model\GenerateableInterface;
use PHPUnit\Framework\TestCase;
use Saci\Console\Domain\Entity\Module;
use Saci\Console\Infrastructure\Domain\Services\ClassMaker;
use Saci\Console\Infrastructure\Domain\Services\PhpClass\Mapping;
use Saci\Console\Infrastructure\Domain\Services\PhpClass\ServiceProvider;

class ClassMakerTest extends TestCase
{
    /** @var ClassMaker */
    private $classMaker;

    public function setUp()
    {
        $this->classMaker = new ClassMaker(new Module('Teste', 'c:\\temp'));
    }

    /**
     * @test
     */
    public function verifica_se_foi_criado_uma_instancia_de_ClassMappingMaker()
    {
        $this->assertInstanceOf(ClassMaker::class, $this->classMaker);
    }

    /**
     * @test
     */
    public function verifica_se_e_possivel_criar_uma_intancia_de_PhpClass_a_partir_da_classe_Mapping()
    {
        $phpClass = $this->classMaker->generate(new Mapping());
//        $expected = <<<PHPCLASS
//namespace Saci\Teste;
//
//use GrupoCoqueiro\CommandBus\MappingInterface;
//
///**
// */
//class Mapping implements MappingInterface
//{
//    /**
//     * Retorna o mapeamento dos commands
//     *
//     * @return array
//     */
//    public function __invoke(): array
//    {
//    }
//}
//
//PHPCLASS;
        $this->assertInstanceOf(GenerateableInterface::class, $phpClass);
    }

    /**
     * @test
     */
    public function verifica_se_e_possivel_criar_uma_intancia_de_PhpClass_a_partir_da_classe_ServiceProvider()
    {
        $phpClass = $this->classMaker->generate(new ServiceProvider());
//        $expected = <<<'PHPCLASS'
//namespace Saci\Teste;
//
//use App\Model\Core\Container\ServiceProvider\ServiceProvider;
//
///**
// */
//class TesteServiceProvider extends ServiceProvider
//{
//    /**
//     * @var array
//     */
//    protected $provides = [];
//
//    /**
//     */
//    public function register()
//    {
//    }
//}
//
//PHPCLASS;

        $this->assertInstanceOf(GenerateableInterface::class, $phpClass);
    }
}
