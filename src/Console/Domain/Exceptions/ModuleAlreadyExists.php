<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 24/11/2018
 * Time: 22:46
 */

namespace Saci\Console\Domain\Exceptions;


class ModuleAlreadyExists extends \Exception
{

    public function __construct(string $moduleName = null, int $code = 0, \Exception $previous = null)
    {
        $message = 'Modulo já existe.';

        if (null ==! $moduleName) {
            $message = sprintf('Modulo "%s" já existe', $moduleName);
        }

        parent::__construct($message, $code, $previous);
    }
}