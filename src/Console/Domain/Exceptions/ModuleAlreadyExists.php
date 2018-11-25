<?php
/**
 * Created by PhpStorm.
 * User: thales
 * Date: 24/11/2018
 * Time: 22:46
 */

namespace Saci\Domain\Exceptions;


class ModuleAlreadyExists extends \Exception
{

    public function __construct(string $message = null, int $code = 0, \Exception $previous = null, string $module = null)
    {
        if (null === $message) {
            if (null === $module) {
                $message = 'Modulo já existe.';
            } else {
                $message = sprintf('Modulo "%s" já existe', $module);
            }
        }

        parent::__construct($message, $code, $previous);
    }
}