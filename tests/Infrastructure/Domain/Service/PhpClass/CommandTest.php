<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 17/01/2019
 * Time: 20:27
 */

namespace Test\Infrastructure\Domain\Service\PhpClass;

use cristianoc72\codegen\model\GenerateableInterface;
use PHPUnit\Framework\TestCase;
use Saci\Console\Domain\Services\Exception\ClassNameIsNullException;
use Saci\Console\Infrastructure\Domain\Services\PhpClass\Command;

class CommandTest extends TestCase
{

    /**
     * @test
     */
    public function verifica_se_sera_retornado_uma_instancia_de_GenerateableInterface()
    {
        $command = (new Command())
            ->setModuleName('Test')
            ->setClassName('Test');
        $this->assertInstanceOf(GenerateableInterface::class, $command->make());
    }

    /**
     * @test
     */
    public function verifica_se_sera_lancado_excecao_casao_nao_seja_informado_a_class_name()
    {
        $this->expectException(ClassNameIsNullException::class);
        $this->expectExceptionMessage('Não foi informado a nome para a Command. Utilize o método setClassName para innforma o nome da classe!');
        $command = (new Command())
            ->setModuleName('Test');
        $this->assertInstanceOf(GenerateableInterface::class, $command->make());
    }
}
