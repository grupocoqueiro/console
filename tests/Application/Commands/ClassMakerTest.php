<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 03/12/2018
 * Time: 16:42
 */

namespace Test\Application\Commands;

use cristianoc72\codegen\generator\CodeGenerator;
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
        $this->classMaker = new ClassMaker(new Module('Teste', 'c:\\temp'), new CodeGenerator([
            'generateScalarTypeHints' => true,
            'generateReturnTypeHints' => true
        ]));
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
    public function verifica_se_foi_criado_uma_classe_Mapping()
    {
        $code = $this->classMaker->generate(new Mapping());
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
        $this->assertEquals($expected, $code);
    }

    /**
     * @test
     */
    public function verifica_se_foi_criado_uma_classe_ServiceProvider()
    {
        $code = $this->classMaker->generate(new ServiceProvider());
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

        $this->assertEquals($expected, $code);
    }
}
