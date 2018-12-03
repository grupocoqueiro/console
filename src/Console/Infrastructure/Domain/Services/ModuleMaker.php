<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 24/11/2018
 * Time: 22:41
 */

namespace Saci\Console\Infrastructure\Domain\Services;


use Saci\Console\Domain\Entity\Module;
use Saci\Console\Domain\Exceptions\ModuleAlreadyExists;
use Symfony\Component\Filesystem\Filesystem;

class ModuleMaker implements \Saci\Console\Domain\Services\ModuleMaker
{

    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @param Module $module
     * @throws \Saci\Console\Domain\Exceptions\ModuleAlreadyExists
     */
    public function make(Module $module)
    {

        if ($this->filesystem->exists($module->getPathModule())) {
            throw new ModuleAlreadyExists($module->getName());
        }

        $this->filesystem->mkdir($module->getPaths());
    }
}