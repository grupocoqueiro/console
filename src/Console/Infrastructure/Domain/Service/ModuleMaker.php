<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 24/11/2018
 * Time: 22:41
 */

namespace Saci\Infrastructure\Domain\Service;


use Saci\Domain\Entity\Module;
use Saci\Domain\Exceptions\ModuleAlreadyExists;
use Symfony\Component\Filesystem\Filesystem;

class ModuleMaker extends Filesystem implements \Saci\Domain\Services\ModuleMaker
{

    /**
     * @param Module $module
     * @throws ModuleAlreadyExists
     */
    public function make(Module $module)
    {

        if ($this->exists($module->getPathModule())) {
            throw new ModuleAlreadyExists($module->getName());
        }

        $this->mkdir($module->getPaths());
    }
}