<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 14/01/2019
 * Time: 19:51
 */

namespace Test\Infrastructure\Domain\Events;

use Saci\Console\Domain\Entity\Command;
use Saci\Console\Infrastructure\Domain\Events\CommandWasCreated;
use PHPUnit\Framework\TestCase;

class CommandWasCreatedTest extends TestCase
{

    /** @var CommandWasCreated */
    private $event;

    public function setUp()
    {
        $command = $this->createMock(Command::class);
        $this->event = new CommandWasCreated($command);
    }

    public function testGetName()
    {
        $this->assertEquals('command.create.event', $this->event->getName());
    }

    public function testGetCommand()
    {
        $this->assertInstanceOf(Command::class, $this->event->getCommand());
    }

    public function test__construct()
    {
        $this->assertInstanceOf(CommandWasCreated::class, $this->event);
    }
}
