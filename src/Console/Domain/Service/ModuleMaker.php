<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 24/11/2018
 * Time: 22:39
 */

namespace Saci\Domain\Services;


use Saci\Domain\Entity\Module;

interface ModuleMaker
{
    public function make(Module $module);
}