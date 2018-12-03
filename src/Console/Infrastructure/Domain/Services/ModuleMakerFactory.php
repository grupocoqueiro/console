<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 03/12/2018
 * Time: 15:28
 */

namespace Saci\Console\Infrastructure\Domain\Services;


use Symfony\Component\Filesystem\Filesystem;

class ModuleMakerFactory
{

    public static function create()
    {
        return new ModuleMaker(new Filesystem());
    }
}