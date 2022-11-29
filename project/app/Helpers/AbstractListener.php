<?php

namespace App\Helpers;

abstract class AbstractListener
{
    abstract public function handle(AbstractEvent $event);
}
