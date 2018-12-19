<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 04/12/2018
 * Time: 18:56
 */

namespace Test\Infrastructure\Domain\Service;

use cristianoc72\codegen\generator\CodeGenerator;
use cristianoc72\codegen\model\GenerateableInterface;
use cristianoc72\codegen\model\PhpClass;
use PHPUnit\Framework\TestCase;
use Saci\Console\Domain\Entity\Module;
use Saci\Console\Domain\Services\GeneratorClass;
use Saci\Console\Infrastructure\Domain\Services\ClassMaker;
use Saci\Console\Infrastructure\Domain\Services\PhpClass\Mapping;
use Saci\Console\Infrastructure\Domain\Services\PhpClass\ServiceProvider;

class GeneratorCalssTest extends TestCase
{

    /**
     * @var \Saci\Console\Infrastructure\Domain\Services\GeneratorClass
     */
    private $generatorClass;

    public function setUp()
    {
        $this->generatorClass = new \Saci\Console\Infrastructure\Domain\Services\GeneratorClass(new CodeGenerator([
            'generateScalarTypeHints' => true,
            'generateReturnTypeHints' => true
        ]));
    }

    /**
     * @test
     */
    public function verifica_se_e_possivel_criar_uma_intancia()
    {
        $this->assertInstanceOf(GeneratorClass::class, $this->generatorClass);
    }

    /**
     * @test
     */
    public function verifica_se_e_possivel_criar_uma_string_de_uma_classe()
    {
        $test = new class extends PhpClass implements \Saci\Console\Domain\Services\PhpClass
        {
            public function make(string $moduleName): GenerateableInterface
            {
                return $this->setQualifiedName("Saci\\{$moduleName}\\Anything");
            }
        };

        $expected = <<<PHPCLASS
namespace Saci\Test;

/**
 */
class Anything
{
}

PHPCLASS;

        $generateable = $test->make('Test');

        $stringClass = $this->generatorClass->generate($generateable);

        $this->assertEquals($expected, $stringClass);
    }

    /**
     * @test
     */
    public function verifica_se_e_possivel_criar_uma_string_de_uma_classe_Mapping()
    {
        $expected = <<<PHPCLASS
namespace Saci\Teste;

use GrupoCoqueiro\CommandBus\MappingInterface;

/**
 */
class Mapping implements MappingInterface
{
    /**
     * Retorna o mapeamento dos commands
     *
     * @return array
     */
    public function __invoke(): array
    {
    }
}

PHPCLASS;

        $cm = new ClassMaker(new Module('Teste', 'c:\\temp'));
        $generateable = $cm->generate(new Mapping());
        $stringClass = $this->generatorClass->generate($generateable);

        $this->assertEquals($expected, $stringClass);
    }

    /**
     * @test
     */
    public function verifica_se_e_possivel_criar_uma_string_de_uma_classe_ServiceProvider()
    {
        $expected = <<<'PHPCLASS'
namespace Saci\Teste;

use App\Model\Core\Container\ServiceProvider\ServiceProvider;

/**
 */
class TesteServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [];

    /**
     */
    public function register()
    {
    }
}

PHPCLASS;

        $cm = new ClassMaker(new Module('Teste', 'c:\\temp'));
        $generateable = $cm->generate(new ServiceProvider());
        $stringClass = $this->generatorClass->generate($generateable);

        $this->assertEquals($expected, $stringClass);
    }
}





