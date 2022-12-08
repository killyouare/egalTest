<?php

namespace App\Abstracts;

abstract class AbstractListenerWithAttributes
{

    abstract public function handle(AbstractEventWithAttributes $event): void;
}
