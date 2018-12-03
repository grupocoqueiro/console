<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 24/11/2018
 * Time: 22:39
 */

namespace Saci\Console\Domain\Services;


use Saci\Console\Domain\Entity\Module;

interface ModuleMaker
{
    public function make(Module $module);
}