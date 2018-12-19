<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 11/12/2018
 * Time: 13:28
 */

namespace Saci\Console\Domain\Events;


interface Event
{
    public function getName(): string;
}